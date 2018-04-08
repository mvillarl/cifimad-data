<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ps2_customer".
 *
 * @property integer $id_customer
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone_mobile
 * @property string $dni
 * @property integer $active
 */
class PS2Customer extends \yii\db\ActiveRecord {
	public $idMember;
	public $phone_mobile;
	public $dni;

	public static function tableName()
	{
		return 'ps2_customer';
	}
	public function rules() {
		return [
			[ [ 'firstname', 'surname' ], 'required' ],
			['email', 'email'],
			['active', 'integer'],
		];
	}

	public function attributeLabels()
	{
		return [
			'id_customer' => 'ID',
			'firstname' => 'Nombre',
			'surname' => 'Apellidos',
			'email' => 'e-mail',
			'active' => 'Activo',
			'phone_mobile' => 'Teléfono',
			'dni' => 'NIF',
		];
	}

	/*public function getPS2Addresses()
	{
		return $this->hasMany(PS2Address::className(), ['id_customer' => 'id_customer']);
	}*/

	public function getFullname() {
		return $this->firstname . ' ' . $this->surname;
	}

	public static function getDb() {
		return Yii::$app->dbtienda;
	}

	public static function find()
	{
		return new PS2CustomerQuery(get_called_class());
	}
}