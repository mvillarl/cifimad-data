<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_press".
 *
 * @property integer $id
 * @property integer $idSource
 * @property string $name
 * @property string $email
 * @property boolean $consent
 * @property string $keyCheck
 *
 * @property Source $idSource0
 */
class Press extends \yii\db\ActiveRecord
{
	public $sourceName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_press';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['idSource'], 'integer'],
            [['consent'], 'boolean'],
            [['name', 'email'], 'string', 'max' => 100],
            [['keyCheck'], 'string', 'max' => 50],
            [['email'], 'unique'],
            [['keyCheck'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idSource' => 'Procedencia',
            'sourceName' => 'Procedencia',
            'name' => 'Nombre',
            'email' => 'Email',
            'consent' => 'Consentimiento para enviar mails',
            'keyCheck' => 'Clave de comprobación',
        ];
    }

    public function getConsentName() {
    	return $this->consent? 'Sí': 'No';
    }

	public function setKey() {
		$this->keyCheck = uniqid('cf');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getIdSource0()
	{
		return $this->hasOne(Source::className(), ['id' => 'idSource']);
	}

	public function getSources($map = false) {
		$sources = Source::find()->where("name LIKE 'Prensa%'")->orderBy('name')->all();
		if ($map) {
			$sources = ArrayHelper::map($sources, 'id', 'name');
			$start = ['' => ''];
			$sources = $start + $sources;
		}

		return $sources;
	}
}
