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
 * @property string $dateEndCosplaySignup
 * @property boolean $isPandemic
 * @property boolean $hasVIPAttendees
 * @property string $deskHelp
 * @property string $imgLogo
 * @property boolean $verticalBadges
 * @property integer $acadiBadges
 * @property string $showInTickets
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
            [['year', 'acadiBadges'], 'integer'],
            [['dateStart', 'dateEnd', 'dateSentInfoHotel', 'dateBadgesPrinted', 'dateEndCosplaySignup', 'isPandemic', 'hasVIPAttendees', 'verticalBadges', 'showInTickets'], 'safe'],
	        [['isPandemic', 'hasVIPAttendees', 'verticalBadges'], 'boolean'],
            [['name'], 'string', 'max' => 60],
            [['imgLogo'], 'string', 'max' => 100],
            [['deskHelp'], 'string'],
            //[['dateStart', 'dateEnd', 'dateSentInfoHotel'], 'date'],
            ['dateStart', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateStart', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            ['dateEnd', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateEnd', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            ['dateEndCosplaySignup', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateEndCosplaySignup', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            [['dateSentInfoHotel', 'dateBadgesPrinted'], 'date', 'format' => 'dd/MM/yyyy', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            [['dateStart'], 'compare', 'compareAttribute' => 'dateEnd', 'operator' => '<', 'enableClientValidation' => false],
            [['showInTickets'], 'string', 'max' => 1],
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
            'dateEndCosplaySignup' => 'Fecha límite de inscripción al concurso de cosplay',
	        'isPandemic' => 'Modo pandemia',
	        'hasVIPAttendees' => 'Hay asistentes VIP',
	        'verticalBadges' => 'Todas las acreditaciones verticales',
            'acadiBadges' => 'Acreditaciones para ACADI',
            'deskHelp' => 'Ayuda para acreditaciones',
            'imgLogo' => 'Logo especial en informes',
            'showInTickets' => 'Mostrar en tickets',
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

    public function load($request, $formName = null) {
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
        $evdata = Event::find()->where(['>=', 'dateStart', date ("Y-m-d")])->orderBy('dateStart')->limit(1)->one();
        return $evdata->id;
    }

    public static function getIdLastEvent() {
        $evdata = Event::find()->where(['<', 'dateStart', date ("Y-m-d")])->orderBy('dateStart DESC')->limit(1)->one();
        return $evdata->id;
    }

    public static function getShowInTicketsValues() {
        return [
            '' => '(nada)',
            'S' => 'Regalo staff',
            'V' => 'Regalo VIP',
            'B' => 'Ambos',
        ];
    }

    public function getShowInTicketsValue() {
        $values = $this->getShowInTicketsValues();
        return $values[$this->showInTickets];
    }
}
