<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_attendee_sales".
 *
 * @property int $id
 * @property int $idEvent
 * @property string $name
 * @property string $phone
 * @property string $ticketType
 * @property string $authorizedBy
 * @property string $authorizedReason
 *
 * @property CifEvents $idEvent0
 */
class AttendeeSale extends \yii\db\ActiveRecord
{
    protected $_idEvent;
    public $eventName;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cif_attendee_sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idEvent', 'name', 'phone', 'ticketType'], 'required'],
            [['idEvent'], 'integer'],
            ['idEvent', 'default', 'value' => $this->_idEvent],
            [['name'], 'string', 'max' => 100],
            [['phone', 'authorizedBy'], 'string', 'max' => 50],
            [['ticketType'], 'string', 'max' => 1],
            [['authorizedReason'], 'string', 'max' => 2000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idEvent' => 'Evento',
            'eventName' => 'Evento',
            'name' => 'Nombre y apellidos',
            'phone' => 'Teléfono',
            'ticketType' => 'Tipo de pase',
            'authorizedBy' => 'Autorizado por',
            'authorizedReason' => 'Razón para autorizar',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

    public function setEvent ($idEvent)
    {
        $this->idEvent = $idEvent;
        $this->_idEvent = $idEvent;
    }

    public static function getTicketTypes() {
        return Attendee::getTicketTypes();
    }

    public function getTicketTypeValue() {
        $types = $this->getTicketTypes();
        return $types[$this->ticketType];
    }
}
