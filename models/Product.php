<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cif_products".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property string $name
 *
 * @property Event $idEvent0
 */
class Product extends \yii\db\ActiveRecord
{
	public $eventName;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'name'], 'required'],
            [['idEvent'], 'integer'],
            [['name'], 'string', 'max' => 60],
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
}
