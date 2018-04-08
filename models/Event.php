<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cif_events".
 *
 * @property integer $id
 * @property integer $year
 * @property string $name
 * @property string $dateStart
 * @property string $dateEnd
 * @property string $dateSentInfoHotel
 * @property string $dateBadgesPrinted
 *
 * @property CifAttendees[] $cifAttendees
 * @property CifGuests[] $cifGuests
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['year', 'name', 'dateStart', 'dateEnd'], 'required'],
            [['year'], 'integer'],
            [['dateStart', 'dateEnd', 'dateSentInfoHotel', 'dateBadgesPrinted'], 'safe'],
            [['name'], 'string', 'max' => 60],
            //[['dateStart', 'dateEnd', 'dateSentInfoHotel'], 'date'],
            ['dateStart', 'date', 'timestampAttribute' => 'dateStart', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            ['dateEnd', 'date', 'timestampAttribute' => 'dateEnd', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            [['dateSentInfoHotel', 'dateBadgesPrinted'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['dateStart'], 'compare', 'compareAttribute' => 'dateEnd', 'operator' => '<'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'year' => 'Año',
            'name' => 'Nombre',
            'dateStart' => 'Fecha de inicio',
            'dateEnd' => 'Fecha de fin',
            'dateSentInfoHotel' => 'Información enviada al hotel',
            'dateBadgesPrinted' => 'Primera impresión de acreditaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees()
    {
        return $this->hasMany(Attendee::className(), ['idEvent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGuests()
    {
        return $this->hasMany(Guest::className(), ['idEvent' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['idEvent' => 'id']);
    }

    public function getYears() {
        $ret = array();
        for ($year = 2016; $year <= (date('Y') + 1); $year++) $ret[$year] = $year;
        return $ret;
    }

    public function load($request) {
        //print_r($request);die;
        $ret = parent::load($request);
        if($ret && $request['dateSentInfoHotelNow']) {
            $this->dateSentInfoHotel = date ('Y-m-d H:i:s');
        }
        if($ret && $request['dateBadgesPrintedNow']) {
            $this->dateBadgesPrinted = date ('Y-m-d H:i:s');
        }
        return $ret;
    }

    public static function getIdNextEvent() {
        $evdata = Event::find()->where(['>', 'dateStart', date ("Y-m-d")])->orderBy('dateStart' ,'ASC')->limit(1)->one();
        return $evdata->id;
    }

    public static function getIdLastEvent() {
        $evdata = Event::find()->where(['<', 'dateStart', date ("Y-m-d")])->orderBy('dateStart' ,'DESC')->limit(1)->one();
        return $evdata->id;
    }
}
