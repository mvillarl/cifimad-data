<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;

/**
 * This is the model class for table "cif_volunteer_inscriptions".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $nameFacebook
 * @property string $functionOther
 * @property string $shiftOther
 * @property string $otherVolunteer
 * @property string $computersLevel
 * @property boolean $status
 * @property string $activitiesRequired
 * @property string $activitiesDesired
 *
 * @property Event $idEvent0
 * @property VolunteerInscriptionFunction[] $volunteerInscriptionFunctions
 * @property VolunteerInscriptionShift[] $volunteerInscriptionShifts
 */
class VolunteerInscription extends \yii\db\ActiveRecord
{
	public $eventName;

	public function behaviors() {
		$b = parent::behaviors();
		$b['saveRelations'] = [
				'class'     => SaveRelationsBehavior::className(),
				'relations' => [
					'volunteerInscriptionFunctions' => ['cascadeDelete' => true],
					'volunteerInscriptionShifts' => ['cascadeDelete' => true],
				],
			];
		return $b;
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_volunteer_inscriptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'name'], 'required'],
            [['idEvent', 'computersLevel'], 'integer'],
            [['name', 'email', 'phone', 'nameFacebook', 'functionOther', 'shiftOther'], 'string', 'max' => 100],
            [['otherVolunteer'], 'string', 'max' => 500],
            [['activitiesRequired', 'activitiesDesired'], 'string', 'max' => 65536],
            [['idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['idEvent' => 'id']],
	        [['volunteerInscriptionFunctions', 'volunteerInscriptionShifts'], 'safe'],
            [['status'], 'boolean'],
            ['status', 'default', 'value' => true],
        ];
    }

	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_ALL,
		];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEvent' => 'Evento',
            'eventName' => 'Evento',
            'name' => 'Nombre',
            'email' => 'E-mail',
            'phone' => 'Teléfono',
            'nameFacebook' => 'Nombre en redes sociales',
            'functionOther' => 'Dónde colaborar - otra',
            'shiftOther' => 'Disponibilidad - otra',
            'otherVolunteer' => 'Datos de otro voluntario',
	        'computersLevel' => 'Conocimientos de informática',
	        'computersLevelValue' => 'Conocimientos de informática',
            'status' => 'Activo',
            'activitiesRequired' => 'Actividades en las que participa',
            'activitiesDesired' => 'Actividades que no se quiere perder',
            'volunteerInscriptionFunctions' => '¿Dónde podría colaborar?',
            'volunteerInscriptionShifts' => 'Disponibilidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

	public static function getEvents($map = false) {
		$events = Event::find()->all();
		if ($map) $events = ArrayHelper::map($events, 'id', 'name');

		return $events;
	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolunteerInscriptionFunctions()
    {
        return $this->hasMany(VolunteerInscriptionFunction::className(), ['idVolunteer' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolunteerInscriptionShifts()
    {
        return $this->hasMany(VolunteerInscriptionShift::className(), ['idVolunteer' => 'id']);
    }


	/**
	 * @inheritdoc
	 * @return AttendeeQuery the active query used by this AR class.
	 */
	public static function find()
	{
		return new VolunteerInscriptionQuery(get_called_class());
	}

	public function load($request, $formName = null) {
		//print_r($request);die;
		$ret = parent::load($request, $formName);
		if($ret && isset ($request['functions']) ) {
			$ret = $this->_populateFunctions ($request['functions']);
			//$this->dateSentInfoHotel = date ('Y-m-d H:i:s');
		}
		if($ret && isset ($request['shifts']) ) {
			$ret = $this->_populateShifts ($request['shifts']);
			//$this->dateBadgesPrinted = date ('Y-m-d H:i:s');
		}
		return $ret;
	}

	protected function _populateFunctions ($functions) {
    	// Cambiarlo por variable miembro con sufijo ToSave
		$volunteerInscriptionFunctions = [];
		foreach ($functions as $function) {
			$fun = new VolunteerInscriptionFunction();
			$fun->idVolunteer = $this->id;
			$fun->volunteerFunction = $function;
			$volunteerInscriptionFunctions[] = $fun;
		}
		$this->volunteerInscriptionFunctions = $volunteerInscriptionFunctions;
		return true;
	}

	protected function _populateShifts ($shifts) {
		$volunteerInscriptionShifts = [];
		foreach ($shifts as $shift) {
			$sh = new VolunteerInscriptionShift();
			$sh->idVolunteer = $this->id;
			$sh->volunteerShift = $shift;
			$volunteerInscriptionShifts[] = $sh;
		}
		$this->volunteerInscriptionShifts = $volunteerInscriptionShifts;
		return true;
	}

	public function getFunctionsValue() {
    	$value = '';
		$functions = VolunteerInscriptionFunction::getFunctions();
    	foreach ($this->volunteerInscriptionFunctions as $function) {
    		if (!empty ($value)) $value .= ', ';
		    $value .= $functions[$function->volunteerFunction];
	    }
    	return $value;
	}

	public function getShiftsValue() {
    	$value = '';
		$shifts = VolunteerInscriptionShift::getShifts();
    	foreach ($this->volunteerInscriptionShifts as $shift) {
    		if (!empty ($value)) $value .= ', ';
		    $value .= $shifts[$shift->volunteerShift];
	    }
    	return $value;
	}

	public function hasFunction ($function) {
		$ret = false;
		foreach ($this->volunteerInscriptionFunctions as $volunteerInscriptionFunction) {
			if ($volunteerInscriptionFunction->volunteerFunction == $function) {
				$ret = true;
				break;
			}
		}
		return $ret;
	}

	public function hasShift ($shift) {
		$ret = false;
		foreach ($this->volunteerInscriptionShifts as $volunteerInscriptionShift) {
			if ($volunteerInscriptionShift->volunteerShift == $shift) {
				$ret = true;
				break;
			}
		}
		return $ret;
	}

	public static function getComputersLevels() {
		return [
			'' => '(No especificado)',
			'1' => 'Básico',
			'2' => 'Intermedio',
			'3' => 'Avanzado',
		];
	}

	public function getComputersLevelValue() {
		$levels = $this->getComputersLevels();
		return isset ($levels[$this->computersLevel])? $levels[$this->computersLevel]: '';
	}

	public function getStatusValue() {
	    return $this->status? 'Sí': 'No';
    }

	/*public function afterSave( $insert, $changedAttributes ) {
		if (!parent::afterSave( $insert, $changedAttributes ) ) {
			return false;
		}
		if (!$this->saveFunctions() ) return false;
		if (!$this->saveShifts() ) return false;
		return true;
	}

	protected function saveFunctions() {
		foreach ($this->VolunteerInscriptionFunctions as $volunteerInscriptionFunction) {
			$volunteerInscriptionFunction->idVolunteer = $this->id;
			$ret = $volunteerInscriptionFunction->save();
			if (!$ret) return false;
		}
		return true;
	}

	protected function saveShifts() {
		foreach ($this->VolunteerInscriptionShifts as $volunteerInscriptionShift) {
			$volunteerInscriptionShift->idVolunteer = $this->id;
			$ret = $volunteerInscriptionShift->save();
			if (!$ret) return false;
		}
		return true;
	}*/
}
