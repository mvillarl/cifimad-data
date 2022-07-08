<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_guests".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property string $name
 * @property string $surname
 * @property string $characterName
 * @property integer $order
 * @property string $dateArrival
 * @property string $dateDeparture
 * @property boolean $hasAutograph
 * @property boolean $hasPhotoshoot
 * @property boolean $hasPhotoshootSpecial
 * @property boolean $hasAutographSpecial
 * @property boolean $hasSelfie
 * @property boolean $hasAutographSelfieCombo
 * @property boolean $hasVintage
 * @property boolean $nif_passport
 * @property string $remarks
 * @property string $remarksMeals
 * @property string $remarksMealsSaturday
 * @property string pseudonym
 *
 * @property Event $idEvent0
 */
class Guest extends \yii\db\ActiveRecord
{
    public $eventName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_guests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'name', 'surname', 'order', 'dateArrival', 'dateDeparture'], 'required'],
            [['idEvent', 'order'], 'integer'],
            [['dateArrival', 'dateDeparture'], 'safe'],
            [['hasAutograph', 'hasPhotoshoot','hasPhotoshootSpecial', 'hasAutographSpecial', 'hasSelfie', 'hasAutographSelfieCombo', 'hasVintage'], 'boolean'],
            [['name', 'surname'], 'string', 'max' => 60],
            [['characterName', 'pseudonym'], 'string', 'max' => 100],
            [['nif_passport'], 'string', 'max' => 25],
	        [['remarks', 'remarksMeals', 'remarksMealsSaturday'], 'string'],
            [['idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['idEvent' => 'id']],
            ['dateArrival', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateArrival', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            ['dateDeparture', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateDeparture', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            [['dateArrival'], 'compare', 'compareAttribute' => 'dateDeparture', 'operator' => '<', 'enableClientValidation' => false],
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
            'surname' => 'Apellido',
            'characterName' => 'Personaje',
            'order' => 'Orden',
            'dateArrival' => 'Fecha de llegada',
            'dateDeparture' => 'Fecha de salida',
            'hasAutograph' => '¿Tiene firma?',
            'hasPhotoshoot' => '¿Tiene foto?',
            'hasPhotoshootSpecial' => '¿Tiene foto especial?',
            'hasAutographSpecial' => '¿Tiene firma especial?',
            'hasSelfie' => '¿Tiene selfie?',
            'hasAutographSelfieCombo' => '¿Tiene combo firma / selfie?',
            'hasVintage' => '¿Tiene cartón vintage?',
            'nif_passport' => 'DNI / Pasaporte',
            'remarks' => 'Observaciones',
            'remarksMeals' => 'Observaciones comidas',
            'remarksMealsSaturday' => 'Opción menú cena de gala',
            'pseudonym' => 'Seudónimo',
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

    public function getFullname() {
        return $this->name . ' ' . $this->surname;
    }

	public function getCompanions()
	{
		return $this->hasMany(Companion::className(), ['idGuest' => 'id'])->all();
	}
}
