<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_volunteer_inscriptions".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property string $name
 * @property string $email
 * @property string $nameFacebook
 *
 * @property Event $idEvent0
 * @property VolunteerInscriptionFunction[] $VolunteerInscriptionFunctions
 * @property VolunteerInscriptionShift[] $VolunteerInscriptionShifts
 */
class VolunteerInscription extends \yii\db\ActiveRecord
{
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
            [['idEvent', 'name', 'email', 'nameFacebook'], 'required'],
            [['idEvent'], 'integer'],
            [['name', 'email', 'nameFacebook'], 'string', 'max' => 100],
            [['idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['idEvent' => 'id']],
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
            'name' => 'Nombre',
            'email' => 'E-mail',
            'nameFacebook' => 'Nombre en Facebook',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

	public function getEvents($map = false) {
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
    public function getVolunteerInscriptionShift()
    {
        return $this->hasMany(VolunteerInscriptionShift::className(), ['idVolunteer' => 'id']);
    }
}
