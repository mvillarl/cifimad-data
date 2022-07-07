<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_members".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $badgeName
 * @property string $badgeSurname
 * @property string $email
 * @property string $nif
 * @property string $phone
 * @property string $remarks
 * @property boolean $status
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $consent
 * @property string $keyCheck
 * @property string $small
 * @property string $vaccine
 *
 * @property Attendee[] $cifAttendees
 * @property Event[] $idEvents
 */
class Member extends \yii\db\ActiveRecord
{
    public function behaviors() {
        $b = parent::behaviors();
        $b[] = [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
            ],
            // if you're using datetime instead of UNIX timestamp:
            'value' => new Expression('NOW()'),
        ];
        return $b;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_members';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name', 'surname', 'badgeName', 'badgeSurname', 'email'], 'string', 'max' => 100],
	        [['keyCheck'], 'string', 'max' => 50],
	        [['vaccine'], 'string', 'max' => 1],
	        [['remarks'], 'string'],
	        [['status', 'consent', 'small'], 'boolean'],
            [['badgeName', 'badgeSurname'], 'default', 'value' => function ($model, $attribute) {
                return Member::cleanup( ($attribute == 'badgeName')? $model->name: $model->surname );
            }],
            [['nif', 'phone'], 'string', 'max' => 25],
            [['email'], 'unique'],
            [['nif'], 'unique'],
            [['email', 'nif'], 'default', 'value' => null],
            [['createdAt', 'updatedAt'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'surname' => 'Apellidos',
            'badgeName' => 'Nombre acreditación',
            'badgeSurname' => 'Apellidos acreditación',
            'email' => 'E-mail',
            'nif' => 'NIF',
            'phone' => 'Teléfono',
            'remarks' => 'Observaciones',
	        'status' => 'Activo',
	        'consent' => 'Consentimiento para enviar mails',
	        'small' => 'Acreditación en letra pequeña',
	        'vaccine' => 'Vacunación contra Covid-19',
	        'keyCheck' => 'Clave de verificación',
            'createdAt' => 'Fecha de creación',
            'updatedAt' => 'Fecha de modificación',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCifAttendees()
    {
        return $this->hasMany(Attendee::className(), ['idMember' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'idEvent'])->viaTable('cif_attendees', ['idMember' => 'id']);
    }

    public function getFullname() {
        return $this->name . ' ' . $this->surname;
    }

    public function getFullbadgename() {
        return $this->badgeName . ' ' . $this->badgeSurname;
    }

	public static function getVaccineOptions() {
		return [
			'' => '',
			'P' => 'Pauta parcial',
			'C' => 'Pauta completa',
			'N' => 'No tiene',
			'R' => 'Prefiere no decirlo',
		];
	}

	public function getVaccineValue() {
		$vacc = $this->getVaccineOptions();
		return $vacc[$this->vaccine];
	}

	public static function getStatusMap() {
		return [
			'' => '',
			'0' => 'No',
			'1' => 'Sí',
		];
	}

	public function getStatusValue() {
		$status = $this->getStatusMap();
		return $status[$this->status];
	}

	public static function getLastLoadFrom($part) {
        $filename = Yii::$app->basePath . '/runtime/loadfrom'.strtolower($part).'flag.txt';
        $date = '';
        if (is_file ($filename)) {
            $date = file_get_contents($filename);
        }
        return $date;
    }

    public static function setLastLoadFrom($part) {
        $filename = Yii::$app->basePath . '/runtime/loadfrom'.strtolower($part).'flag.txt';
        $f = fopen($filename, 'w');
        fputs($f, date ("Y-m-d H:i:s"));
        fclose($f);
    }

    public static function membersMatchCustomers ($members, &$customers, &$matching, &$nomatch) {
        $matching = [];
        $nomatch = [];
        foreach ($customers as $email => $customer) {
            if (isset ($members[$email])) {
                $customer->idMember = $members[$email]->id;
                $customers[$email]->idMember = $customer->idMember;
                $matching[] = $customer;
            } else {
                $nomatch[] = $customer;
            }
        }
    }

	public static function membersMatchConsents ($members, $consents, &$matchconsents) {
		$matchconsents = [];
		foreach ($consents as $email => $consent) {
			if (isset ($members[$email])) {
				$consent->idMember = $members[$email]->id;
				$consents[$email]->idMember = $consent->idMember;
				$matchconsents[] = $members[$email];
			}
		}
	}

    public static function upsertMembersFromCustomers ($customerstoupsert, &$stats, &$errors) {
        $stats['total'] = 0;
        $stats['inserted'] = 0;
        $stats['modified'] = 0;
        $stats['witherrors'] = 0;
        $errors = [];
        foreach ($customerstoupsert as $customer) {
            $stats['total']++;
            $member = new Member();
            if (isset ($customer->idMember)) {
                $member = Member::findOne ($customer->idMember);
            }
            if (!strlen ($member->keyCheck)) $member->setKey();
            $member->name = $customer->firstname;
            $member->surname = $customer->lastname;
            $member->email = $customer->email;
            if (strlen ($customer->phone_mobile) ) $member->phone = $customer->phone_mobile;
            if (strlen ($customer->dni) ) $member->nif = $customer->dni;
	        $member->consent = true; // Asumimos que un socio nuevo ha marcado casilla consentimiento
            if ($member->save() ) {
                if (isset ($customer->idMember)) $stats['modified']++;
                else $stats['inserted']++;
            } else {
                //die('<pre>'.print_r($member,true));
                $stats['witherrors']++;
                $errors[$member->email] = $member->errors;
            }
        }
        
    }

    public static function termSearch ($term) {
        $term = trim ($term);
        $query = Member::find()->where (['or', 'name LIKE :term', 'surname LIKE :term', 'badgeName LIKE :term', 'badgeSurname LIKE :term'], [':term' => '%'.$term.'%']);
        $members = $query->all();
        $ret = [];
        foreach ($members as $member) {
            $ret[] = ['value' => $member->id, 'label' => $member->fullBadgename];
        }
        return $ret;
    }

    public function setKey() {
    	$this->keyCheck = uniqid('cf');
    }

	public static function setKeys() {
		$query = Member::find()->where("keyCheck IS NULL OR keyCheck = ''");
		$members = $query->all();
		foreach ($members as $member) {
			$member->setKey();
			$member->save();
		}
		return count ($members);
	}

	public function readFromKeyFields() {
        $query = Member::find()->where("email = :email OR nif = :nif", ['email' => $this->email, 'nif' => $this->nif]);
        $checkmembers = $query->all();
        if (count ($checkmembers) > 0) {
            $ret = true;
            $this->id = $checkmembers[0]->id;
        } else {
            $ret = false;
        }
        return $ret;
    }

    public static function cleanup ($text) {
        $rpl = [
            'á' => 'a',
            'à' => 'a',
            'Á' => 'A',
            'À' => 'A',
            'é' => 'e',
            'è' => 'e',
            'ë' => 'e',
            'É' => 'E',
            'È' => 'E',
            'Ë' => 'E',
            'í' => 'i',
            'ì' => 'i',
            'Í' => 'I',
            'Ì' => 'I',
            'ó' => 'o',
            'ò' => 'o',
            'Ó' => 'O',
            'Ò' => 'O',
            'ú' => 'u',
            'ù' => 'u',
            'ü' => 'u',
            'Ú' => 'U',
            'Ù' => 'U',
            'Ü' => 'U',
            'ç' => 'c',
            'Ç' => 'C',
            'º' => 'o',
            'ª' => 'a',
        ];
        return strtr($text, $rpl);
    }
}
