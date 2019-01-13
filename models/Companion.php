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
 * @property string $nif_passport
 * @property string $remarks
 * @property string $remarksMeals
 * @property boolean $separateRoom
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
            [['remarks'], 'string'],
            [['remarksMeals'], 'string'],
            [['name', 'surname'], 'string', 'max' => 60],
            [['nif_passport'], 'string', 'max' => 25],
            [['separateRoom'], 'boolean'],
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
            'nif_passport' => 'NIF / Pasaporte',
            'remarks' => 'Observaciones',
            'remarksMeals' => 'Observaciones comidas',
	        'separateRoom' => '¿Habitación separada?',
        ];
    }

	public function getFullname() {
		return $this->name . ' ' . $this->surname;
	}

	public static function getGuests($map = false) {
		$idEvent = Yii::$app->session->get('Attendee.idEvent');
		$guests = Event::findOne($idEvent)->getGuests()->all();
		if ($map) $guests = ArrayHelper::map($guests, 'id', 'name');

		return $guests;
	}

}
