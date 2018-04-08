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
	        [['remarks'], 'string'],
	        [['status'], 'boolean'],
            [['badgeName', 'badgeSurname'], 'default', 'value' => function ($model, $attribute) {
                return ($attribute == 'badgeName')? $model->name: $model->surname;
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
            $member->name = $customer->firstname;
            $member->surname = $customer->lastname;
            $member->email = $customer->email;
            if (strlen ($customer->phone_mobile) ) $member->phone = $customer->phone_mobile;
            if (strlen ($customer->dni) ) $member->nif = $customer->dni;
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

}
