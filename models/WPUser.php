<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wp_users".
 *
 * @property integer $id
 * @property string $user_login
 * @property string $user_email
 * @property string $user_registered
 * @property string $user_status
 */
class WPUser extends \yii\db\ActiveRecord {
	public $idMember;
	public $firstname;
	public $lastname;
	public $bphone;
	public $sphone;
//	public $phone_mobile;
	public $bdni;
	public $sdni;
//	public $dni;

	public static function tableName()
	{
		return 'wp_users';
	}
	public function rules() {
		return [
			[ [ 'user_login' ], 'required' ],
			['user_email', 'email'],
			['user_status', 'integer'],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'firstname' => 'Nombre',
			'surname' => 'Apellidos',
			'user_email' => 'e-mail',
			'user_status' => 'Activo',
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

	public function getEmail() {
		return $this->user_email;
	}

	public function getPhone_Mobile() {
		return strlen ($this->bphone)? $this->bphone: $this->sphone;
	}

	public function getDNI() {
		return strlen ($this->bdni)? $this->bdni: $this->sdni;
	}

	public static function getDb() {
		return Yii::$app->dbwordpress;
	}

	public static function find()
	{
		return new WPUserQuery(get_called_class());
	}
}