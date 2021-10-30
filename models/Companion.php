<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_companions".
 *
 * @property integer $id
 * @property integer $idGuest
 * @property string $name
 * @property string $surname
 * @property string $badgeName
 * @property string $badgeSurname
 * @property string $nif_passport
 * @property string $remarks
 * @property string $remarksMeals
 * @property string $remarksMealsSaturday
 * @property boolean $separateRoom
 * @property boolean $excludeLodging
 * @property boolean $excludeFridayDinner
 */
class Companion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_companions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idGuest', 'name', 'surname'], 'required'],
            [['idGuest'], 'integer'],
            [['remarks', 'remarksMeals', 'remarksMealsSaturday'], 'string'],
            [['name', 'surname', 'badgeName', 'badgeSurname'], 'string', 'max' => 60],
            [['nif_passport'], 'string', 'max' => 25],
            [['separateRoom', 'excludeLodging', 'excludeFridayDinner'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idGuest' => 'Invitado',
            'name' => 'Nombre',
            'surname' => 'Apellido',
            'badgeName' => 'Nombre acreditación',
            'badgeSurname' => 'Apellido acreditación',
            'nif_passport' => 'NIF / Pasaporte',
            'remarks' => 'Observaciones',
            'remarksMeals' => 'Observaciones comidas',
            'remarksMealsSaturday' => 'Opción de menú cena de gala',
	        'separateRoom' => '¿Habitación separada?',
	        'excludeLodging' => 'Excluir alojamiento',
	        'excludeFridayDinner' => 'Excluir cena viernes',
        ];
    }

	public function getFullname() {
		return $this->name . ' ' . $this->surname;
	}

	public function getFullBadgeName() {
		return (strlen ($this->badgeName)? $this->badgeName: $this->name) . ' ' . (strlen ($this->badgeSurname)? $this->badgeSurname: $this->surname);
	}

	public static function getGuests($map = false) {
		$idEvent = Yii::$app->session->get('Attendee.idEvent');
		$guests = Event::findOne($idEvent)->getGuests()->all();
		if ($map) $guests = ArrayHelper::map($guests, 'id', 'name');

		return $guests;
	}

}
