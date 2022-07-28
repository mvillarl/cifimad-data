<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use app\components\DateFunctions;

/**
 * This is the model class for table "cif_attendees".
 *
 * @property integer $id
 * @property integer $idEvent
 * @property integer $idMember
 * @property string $status
 * @property string $ticketType
 * @property boolean $mealFridayDinner
 * @property boolean $mealSaturdayLunch
 * @property boolean $mealSaturdayDinner
 * @property boolean $mealSundayLunch
 * @property boolean $mealSundayDinner
 * @property integer $guest1Photoshoot
 * @property integer $guest1PhotoshootSpecial
 * @property integer $guest1Autograph
 * @property integer $guest1AutographSpecial
 * @property integer $guest1Selfie
 * @property integer $guest1ComboAutographSelfie
 * @property integer $guest1Vintage
 * @property integer $guest2Photoshoot
 * @property integer $guest2PhotoshootSpecial
 * @property integer $guest2Autograph
 * @property integer $guest2AutographSpecial
 * @property integer $guest2Selfie
 * @property integer $guest2ComboAutographSelfie
 * @property integer $guest2Vintage
 * @property integer $guest3Photoshoot
 * @property integer $guest3PhotoshootSpecial
 * @property integer $guest3Autograph
 * @property integer $guest3AutographSpecial
 * @property integer $guest3Selfie
 * @property integer $guest3ComboAutographSelfie
 * @property integer $guest3Vintage
 * @property integer $guest4Photoshoot
 * @property integer $guest4PhotoshootSpecial
 * @property integer $guest4Autograph
 * @property integer $guest4AutographSpecial
 * @property integer $guest4Selfie
 * @property integer $guest4ComboAutographSelfie
 * @property integer $guest4Vintage
 * @property integer $extraProduct1
 * @property integer $extraProduct2
 * @property integer $extraProduct3
 * @property integer $extraProduct4
 * @property integer $idSource
 * @property boolean $isSpecial
 * @property string $roomType
 * @property string $dateStartLodging
 * @property string $dateEndLodging
 * @property boolean $freeLodging
 * @property boolean $freeSaturdayDinner
 * @property integer $idAttendeeRoommate1
 * @property integer $idAttendeeRoommate2
 * @property integer $idAttendeeRoommate3
 * @property integer $idAttendeeParent
 * @property string $remarks
 * @property string $remarksRegistration
 * @property string $remarksMeals
 * @property string $remarksMealSaturday
 * @property string $remarksHotel
 * @property string $orders
 * @property string $cifiKidsDay
 * @property string $parkingReservation
 * @property boolean $isCifiKidsVolunteer
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $updatedAtHotel
 * @property string $updatedAtBadges
 * @property string $updatedAtBadgesTickets
 * @property string $phoneAtDesk
 * @property boolean $remarksOrPendingPaymentDone
 * @property string $memberPhone
 * @property string $parkingOptions
 *
 * @property CifEvents $idEvent0
 * @property CifMembers $idMember0
 * @property CifSources $idSource0
 * @property Attendee $idAttendeeRoommate10
 * @property Attendee[] $attendees
 * @property Attendee $idAttendeeRoommate20
 * @property Attendee[] $attendees0
 * @property Attendee $idAttendeeRoommate30
 * @property Attendee[] $attendees2
 * @property Attendee $idAttendeeParent1
 * @property Attendee[] $attendees1
 */
class Attendee extends \yii\db\ActiveRecord
{
    protected $_idEvent;
    protected $_guests;
    protected $_products;
    protected $_guestFields;
    protected $_extraProductFields;
	protected $_shortLabels;
	protected $_guestFieldColors;
	protected $_extraProductFieldColors;
	protected static $_colors = [
		[],
		['#FFC90E', '#FFFF80', 'mediumpurple', '#FF3E3E', '#FFFFD0', '#00D500', '#80FF80'], // 5 y 6 repiten colores de invitado 4; ojo si hacen falta ambas cosas
		['#00C1C1', '#93E6E6', 'palegoldenrod'],
		['#FF8000', '#C5C5E2', 'lightpink'],
		['#00D500', '#80FF80', 'pink'],
		[],
		['hotpink'],
		['paleturquoise'],
	];

	//protected $_updatedFlag;
	protected $_updatedHotelFlag;
	protected $_updatedBadgesFlag;
	protected $_updatedBadgesTicketsFlag;

    public $eventName;
    public $name;
    public $surname;
    public $badgeName;
    public $badgeSurname;
	public $nif;
	public $memberSmall;
    //public $attendeeName;
    public $sourceName;
    public $sourceImageFile;
    public $roommate1BadgeName;
    public $roommate1BadgeSurname;
    public $roommate2BadgeName;
    public $roommate2BadgeSurname;
    public $roommate3BadgeName;
    public $roommate3BadgeSurname;
    public $parentBadgeName;
    public $parentBadgeSurname;
    public $parentPhone;
	public $memberParentId;
	public $memberVaccine;
	public $memberPhone;
    //public $roommate1Name;
    //public $roommate2Name;
    //public $roommate3Name;
    //public $parentName;

	/*public function setUpdatedFlag() {
		$this->_updatedFlag = true;
	}*/
	protected $_hasPhone;

	public function setUpdatedHotelFlag() {
		$this->_updatedHotelFlag = true;
	}

	public function setUpdatedBadgesFlag() {
		$this->_updatedBadgesFlag = true;
	}

	public function setUpdatedBadgesTicketsFlag() {
		$this->_updatedBadgesTicketsFlag = true;
	}

    public function setEvent ($idEvent, $guests, $products) {
        $this->idEvent = $idEvent;
        $this->_idEvent = $idEvent;
        $this->_guests = $guests;
        $this->_products = $products;
        $gpos = '1';
        $this->_guestFields = [];
        $this->_extraProductFields = [];
        $this->_shortLabels = [];
        $this->_guestFieldColors = [];
        $this->_extraProductFieldColors = [];
        if (is_array ($this->_guests) ) foreach ($this->_guests as $guest) {
            if ($guest->hasPhotoshoot) {
                $this->_guestFields['guest'.$gpos.'Photoshoot'] = 'Foto/s con ' . $guest->fullname;
                $this->_shortLabels['guest'.$gpos.'Photoshoot'] = 'Foto ' . $guest->name;
	            $this->_guestFieldColors['guest'.$gpos.'Photoshoot'] = static::$_colors[$gpos][0];
            }
            if ($guest->hasPhotoshootSpecial) {
                $this->_guestFields['guest'.$gpos.'PhotoshootSpecial'] = 'Foto/s especial/es con ' . $guest->fullname;
                $this->_shortLabels['guest'.$gpos.'PhotoshootSpecial'] = 'Foto especial ' . $guest->name;
	            $this->_guestFieldColors['guest'.$gpos.'PhotoshootSpecial'] = static::$_colors[$gpos][3];
            }
            if ($guest->hasAutograph) {
                $this->_guestFields['guest'.$gpos.'Autograph'] = 'Firma/s de ' . $guest->fullname;
                $this->_shortLabels['guest'.$gpos.'Autograph'] = 'Firma ' . $guest->name;
	            $this->_guestFieldColors['guest'.$gpos.'Autograph'] = static::$_colors[$gpos][1];
            }
	        if ($guest->hasAutographSpecial) {
		        $this->_guestFields['guest'.$gpos.'AutographSpecial'] = 'Firma/s especial/es de ' . $guest->fullname;
		        $this->_shortLabels['guest'.$gpos.'AutographSpecial'] = 'Firma especial ' . $guest->name;
		        $this->_guestFieldColors['guest'.$gpos.'AutographSpecial'] = static::$_colors[$gpos][4];
	        }
	        if ($guest->hasSelfie) {
		        $this->_guestFields['guest'.$gpos.'Selfie'] = 'Selfie/s de ' . $guest->fullname;
		        $this->_shortLabels['guest'.$gpos.'Selfie'] = 'Selfie ' . $guest->name;
		        $this->_guestFieldColors['guest'.$gpos.'Selfie'] = static::$_colors[$gpos][5];
	        }
	        if ($guest->hasAutographSelfieCombo) {
		        $this->_guestFields['guest'.$gpos.'ComboAutographSelfie'] = 'Combo firma/selfie de ' . $guest->fullname;
		        $this->_shortLabels['guest'.$gpos.'ComboAutographSelfie'] = 'Combo ' . $guest->name;
		        $this->_guestFieldColors['guest'.$gpos.'ComboAutographSelfie'] = static::$_colors[$gpos][6];
	        }
            if ($guest->hasVintage) {
                $this->_guestFields['guest'.$gpos.'Vintage'] = 'Cartón/es vintage de ' . $guest->characterName;
                $this->_shortLabels['guest'.$gpos.'Vintage'] = 'Cartón ' . $guest->characterName;
	            $this->_guestFieldColors['guest'.$gpos.'Vintage'] = static::$_colors[$gpos][2];
            }
            $gpos++;
        }
        $guests = $gpos;
	    $gpos = '1';
	    if (is_array ($this->_products) ) foreach ($this->_products as $product) {
		    $this->_extraProductFields['extraProduct'.$gpos] = $product->name;
		    $this->_shortLabels['extraProduct'.$gpos] = $product->name;
		    $this->_extraProductFieldColors['extraProduct'.$gpos] = static::$_colors[$guests + $gpos][0];
		    $gpos++;
	    }
    }

    public function getShortAttributeLabel ($field) {
    	return isset ($this->_shortLabels[$field])? $this->_shortLabels[$field]: $this->getAttributeLabel($field);
    }

	public function getGuestFieldColor ($field) {
		return $this->_guestFieldColors[$field];
	}

	public function getExtraProductFieldColor ($field) {
		return $this->_extraProductFieldColors[$field];
	}

    public function getGuestFields() {
        return is_array ($this->_guestFields)? array_keys($this->_guestFields): [];
    }

    public function getExtraProductFields() {
        return is_array ($this->_extraProductFields)? array_keys($this->_extraProductFields): [];
    }

    public function behaviors() {
        $b = parent::behaviors();
        $b[] = [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_INSERT => ['createdAt', 'updatedAt', 'updatedAtHotel', 'updatedAtBadges', 'updatedAtBadgesTickets'],
                ActiveRecord::EVENT_BEFORE_UPDATE => ['updatedAt'],
                //ActiveRecord::EVENT_BEFORE_UPDATE => [],
            ],
            // if you're using datetime instead of UNIX timestamp:
            'value' => new Expression('NOW()'),
        ];
        return $b;
    }

	public function beforeSave($insert)
	{
		if (!parent::beforeSave($insert)) {
			return false;
		}

		// Actualizamos los distintos updatedAt sólo si nos lo marcan los flags
		/*if ($this->_updatedFlag) {
			$this->updatedAt = new Expression('NOW()');
		}*/
		if ($this->_updatedHotelFlag) {
			$this->updatedAtHotel = new Expression('NOW()');
		}
		if ($this->_updatedBadgesFlag) {
			$this->updatedAtBadges = new Expression('NOW()');
		}
		if ($this->_updatedBadgesTicketsFlag) {
			$this->updatedAtBadgesTickets = new Expression('NOW()');
		}
		return true;
	}

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cif_attendees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idEvent', 'idMember', 'ticketType', 'idSource', 'status'], 'required'],
            ['idEvent', 'default', 'value' => $this->_idEvent],
            [['idEvent', 'idMember', 'guest1Photoshoot', 'guest1PhotoshootSpecial', 'guest1Autograph', 'guest1AutographSpecial', 'guest1Selfie', 'guest1ComboAutographSelfie', 'guest1Vintage', 'guest2Photoshoot', 'guest2PhotoshootSpecial', 'guest2Autograph', 'guest2AutographSpecial', 'guest2Selfie', 'guest2ComboAutographSelfie', 'guest2Vintage', 'guest3Photoshoot', 'guest3PhotoshootSpecial', 'guest3Autograph', 'guest3AutographSpecial', 'guest3Selfie', 'guest3ComboAutographSelfie', 'guest3Vintage', 'guest4Photoshoot', 'guest4PhotoshootSpecial', 'guest4Autograph', 'guest4AutographSpecial', 'guest4Selfie', 'guest4ComboAutographSelfie', 'guest4Vintage', 'extraProduct1', 'extraProduct2', 'extraProduct3', 'extraProduct4', 'idSource', 'idAttendeeRoommate1', 'idAttendeeRoommate2', 'idAttendeeRoommate3'], 'integer'],
            [['mealFridayDinner', 'mealSaturdayLunch', 'mealSaturdayDinner', 'mealSundayLunch', 'mealSundayDinner', 'isSpecial', 'freeLodging', 'freeSaturdayDinner'/*, 'memberSmall'*/, 'isCifiKidsVolunteer'], 'boolean'],
            [['dateStartLodging', 'dateEndLodging', 'createdAt', 'updatedAt', 'updatedAtHotel', 'updatedAtBadges', 'updatedAtBadgesTickets', 'remarksOrPendingPaymentDone', 'memberPhone'], 'safe'],
            [['remarks', 'remarksRegistration', 'remarksMeals', 'remarksMealSaturday', 'remarksHotel', 'orders', 'parkingReservation', 'phoneAtDesk'], 'string'],
            [['status', 'ticketType', 'roomType', 'cifiKidsDay', 'parkingOptions'], 'string', 'max' => 1],
            [['idEvent', 'idMember'], 'unique', 'targetAttribute' => ['idEvent', 'idMember'], 'message' => 'Este socio ya está incluido en este evento.'/*, 'filter' => function($q){
                    $parms = $q->where;
                    $q->where (['and', ['cif_attendees.idEvent' => ':idEvent'] , ['cif_attendees.idMember' => ':idMember'] ], $parms);
            }*/],
            [['idEvent'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['idEvent' => 'id']],
            [['idMember'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['idMember' => 'id']],
            [['idSource'], 'exist', 'skipOnError' => true, 'targetClass' => Source::className(), 'targetAttribute' => ['idSource' => 'id']],
            [['idAttendeeRoommate1'], 'exist', 'skipOnError' => true, 'targetClass' => Attendee::className(), 'targetAttribute' => ['idAttendeeRoommate1' => 'id']],
            [['idAttendeeRoommate2'], 'exist', 'skipOnError' => true, 'targetClass' => Attendee::className(), 'targetAttribute' => ['idAttendeeRoommate2' => 'id']],
	        [['idAttendeeRoommate3'], 'exist', 'skipOnError' => true, 'targetClass' => Attendee::className(), 'targetAttribute' => ['idAttendeeRoommate3' => 'id']],
            [['idAttendeeParent'], 'exist', 'skipOnError' => true, 'targetClass' => Attendee::className(), 'targetAttribute' => ['idAttendeeParent' => 'id']],
            [['createdAt', 'updatedAt', 'updatedAtHotel', 'updatedAtBadges', 'updatedAtBadgesTickets'], 'date', 'format' => 'yyyy-MM-dd HH:mm:ss'],
            ['dateStartLodging', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateStartLodging', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            ['dateEndLodging', 'date', 'format' => 'dd/MM/yyyy', 'timestampAttribute' => 'dateEndLodging', 'timestampAttributeFormat' => 'yyyy-MM-dd'],
            [['dateStartLodging'], 'compare', 'compareAttribute' => 'dateEndLodging', 'operator' => '<', 'enableClientValidation' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = [
            'id' => 'ID',
            'idEvent' => 'Evento',
            'eventName' => 'Evento',
            'idMember' => 'Socio',
            'memberName' => 'Socio',
            'attendeeName' => 'Socio',
            'status' => 'Estado',
            'ticketType' => 'Tipo de pase',
            'mealFridayDinner' => 'Cena Cocktail viernes',
            'mealSaturdayLunch' => 'Comida sábado',
            'mealSaturdayDinner' => 'Cena de Gala sábado',
            'mealSundayLunch' => 'Comida domingo',
            'mealSundayDinner' => 'Cena de los Valientes domingo',
            /*'guest1Photoshoot' => 'Foto con actor 1',
            'guest1Autograph' => 'Firma actor 1',
            'guest2Photoshoot' => 'Foto actor 2',
            'guest2Autograph' => 'Firma actor 2',
            'guest2Vintage' => 'Cartón actor 2',
            'guest3Photoshoot' => 'Foto actor 3',
            'guest3Autograph' => 'Firma actor 3',
            'guest3Vintage' => 'Cartón actor 3',*/
            'idSource' => 'Procedencia',
            'sourceName' => 'Procedencia',
            'isSpecial' => 'Acreditación especial (Cochrane)',
            'roomType' => 'Habitación',
            'dateStartLodging' => 'Se aloja desde',
            'dateEndLodging' => 'Se aloja hasta',
	        'freeLodging' => 'Habitación invitada',
            'freeSaturdayDinner' => 'Cena gala invitada',
            'idAttendeeRoommate1' => 'Compañero de habitación 1',
            'roommate1Name' => 'Compañero de habitación 1',
            'idAttendeeRoommate2' => 'Compañero de habitación 2',
            'roommate2Name' => 'Compañero de habitación 2',
            'idAttendeeRoommate3' => 'Compañero de habitación 3',
            'roommate3Name' => 'Compañero de habitación 3',
            'idAttendeeParent' => 'Padre',
            'parentName' => 'Padre',
            'remarks' => 'Observaciones',
            'remarksRegistration' => 'Observaciones acreditaciones',
            'remarksMeals' => 'Observaciones comidas - general',
            'remarksMealSaturday' => 'Observaciones comidas - cena de gala',
            'remarksHotel' => 'Observaciones hotel',
            'parkingReservation' => 'Reserva de aparcamiento',
            'phoneAtDesk' => 'Teléfono (recogido en acreditaciones)',
            'isCifiKidsVolunteer' => 'Voluntario CifiKids',
	        'orders' => 'Nº pedido/s',
	        'cifiKidsDay' => 'Reserva CifiKids día',
	        'cifiKidsDayValue' => 'Reserva CifiKids día',
            'createdAt' => 'Fecha de creación',
            'updatedAt' => 'Fecha de modificación',
            'updatedAtHotel' => 'Fecha de modificación - datos hotel',
            'updatedAtBadges' => 'Fecha de modificación - acreditación',
            'updatedAtBadgesTickets' => 'Fecha de modificación - acreditación y tickets',
            'remarksOrPendingPaymentDone' => 'Marcar como hecho observaciones / pago pendiente',
            'parkingOptions' => 'Opciones de aparcamiento',
        ];
        if (is_array ($this->_guestFields)) $labels = array_merge ($labels, $this->_guestFields);
        if (is_array ($this->_extraProductFields)) $labels = array_merge ($labels, $this->_extraProductFields);
        return $labels;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'idEvent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMember0()
    {
        return $this->hasOne(Member::className(), ['id' => 'idMember']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSource0()
    {
        return $this->hasOne(Source::className(), ['id' => 'idSource']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAttendeeRoommate10()
    {
        return $this->hasOne(Attendee::className(), ['id' => 'idAttendeeRoommate1'])->alias ('roommate1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees()
    {
        return $this->hasMany(Attendee::className(), ['idAttendeeRoommate1' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAttendeeRoommate20()
    {
        return $this->hasOne(Attendee::className(), ['id' => 'idAttendeeRoommate2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees0()
    {
        return $this->hasMany(Attendee::className(), ['idAttendeeRoommate2' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAttendeeRoommate30()
    {
        return $this->hasOne(Attendee::className(), ['id' => 'idAttendeeRoommate3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees2()
    {
        return $this->hasMany(Attendee::className(), ['idAttendeeRoommate3' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAttendeeParent0()
    {
        return $this->hasOne(Attendee::className(), ['id' => 'idAttendeeParent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees1()
    {
        return $this->hasMany(Attendee::className(), ['idAttendeeParent' => 'id']);
    }

    public function getEventName() {
        return $this->eventName;
    }

    public function getMemberName() {
        return $this->badgeName . ' ' . $this->badgeSurname;
    }

    public function getAttendeeName() {
        return $this->name . ' ' . $this->surname;
    }

    public function getSourceName() {
        return $this->sourceName;
    }

    public function getSourceImageFile() {
        return $this->sourceImageFile;
    }

/*    public function getRoommate1BadgeName() {
        return $this->roommate1BadgeName;
    }

    public function getRoommate1BadgeSurname() {
        return $this->roommate1BadgeSurname;
    }
*/
    public function getRoommate1Name() {
        return $this->roommate1BadgeName . ' ' . $this->roommate1BadgeSurname;
    }

    public function getRoommate2Name() {
        return $this->roommate2BadgeName . ' ' . $this->roommate2BadgeSurname;
    }

    public function getRoommate3Name() {
        return $this->roommate3BadgeName . ' ' . $this->roommate3BadgeSurname;
    }

    public function getParentName() {
        return $this->parentBadgeName . ' ' . $this->parentBadgeSurname;
    }

    /**
     * @inheritdoc
     * @return AttendeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AttendeeQuery(get_called_class());
    }

    public static function getTicketTypes() {
        return [
            '' => '',
            'V' => 'Viernes',
            'S' => 'Sábado',
            'D' => 'Domingo',
            'F' => 'Fin de semana',
            '-' => 'Sin acreditación',
        ];
    }

    public function getTicketTypeValue() {
        $types = $this->getTicketTypes();
        return $types[$this->ticketType];
    }

    public static function getCifiKidsDays() {
        return [
            '' => '',
            'S' => 'Sábado',
            'D' => 'Domingo',
            'B' => 'Los dos días',
        ];
    }

    public function getCifiKidsDayValue() {
        $days = $this->getCifiKidsDays();
        return $days[$this->cifiKidsDay];
    }

    public static function getStatusMap() {
        return [
            '' => '',
            '0' => 'Pendiente de pago',
            '1' => 'Confirmado',
            '2' => 'Cancela alojamiento',
            '3' => 'Cancelado',
            '4' => 'No vino',
        ];
    }

    public function getStatusValue() {
        $status = $this->getStatusMap();
        return $status[$this->status];
    }

	public function getIsSpecialValue() {
		$yesno = ['0' => 'No', '1' => 'Sí'];
		return $yesno[$this->isSpecial];
	}

	public function getRemarksOrPendingPaymentDoneValue() {
		$yesno = ['0' => 'No', '1' => 'Sí'];
		return $yesno[$this->remarksOrPendingPaymentDone];
	}

	public function getIsCifiKidsVolunteerValue() {
		$yesno = ['0' => 'No', '1' => 'Sí'];
		return $yesno[$this->isCifiKidsVolunteer];
	}

    public static function getRoomTypes() {
        return [
            '' => '',
            'I' => 'Individual',
            '1' => 'Individual (grande)',
            'D' => 'Doble matrimonio',
            '2' => 'Doble (camas separadas)',
            'N' => 'Doble + niño',
            'T' => 'Triple',
            '4' => 'Triple + niño',
            'Q' => 'Cuádruple',
            'S' => 'Suite (doble)',
            'U' => 'Suite (individual)',
        ];
    }

    public function getRoomTypeValue() {
        $types = Attendee::getRoomTypes();
        return $types[$this->roomType];
    }

    public static function getParkingOptions() {
        return [
            'P' => 'Enchufe',
            'H' => 'Discapacidad',
        ];
    }

    public function getParkingOptionsValue() {
        $options = Attendee::getParkingOptions();
        return $options[$this->parkingOptions];
    }

    public static function getEvents($map = false) {
        $events = Event::find()->all();
        if ($map) $events = ArrayHelper::map($events, 'id', 'name');

        return $events;
    }

    public static function getSources($map = false, $value = '', $active = true) {
        $sourcesq = Source::find();
        if ($active) {
            if (strlen ($value)) {
                $sourcesq->andWhere(['or', ['status' => true], ['id' => $value]]);
            } else {
                $sourcesq->andWhere(['status' => true]);
            }
        }
        $sources = $sourcesq->orderBy('name', 'ASC')->all();
        if ($map) $sources = ArrayHelper::map($sources, 'id', 'name');

        return $sources;
    }

    public static function getGuests ($idEvent) {
        $guests = Event::findOne($idEvent)->getGuests()->all();
        //print_r($guests);die;
        return $guests;
    }

    public static function getProducts ($idEvent) {
        $products = Event::findOne($idEvent)->getProducts()->all();
        //print_r($products);die;
        return $products;
    }

    public function getMemberVaccineValue() {
	    $vacc = Member::getVaccineOptions();
	    return $vacc[$this->memberVaccine];
    }

    public function getHasPhoneValue() {
        return !empty ($this->memberPhone)? 'Sí': 'No';
    }

    public function getHasPhone() {
        return $this->_hasPhone;
    }

    public function setHasPhone ($hasPhone) {
        $this->_hasPhone = $hasPhone;
    }

    public static function termSearch ($term, $idEevent = null) {
        $query = Attendee::find()->andFilterSearchMember ($term);
	    if (strlen ($idEevent)) $query = $query->andFilterEvent($idEevent);
        $attendees = $query->all();
        $ret = [];
        foreach ($attendees as $attendee) {
            $ret[] = ['value' => $attendee->id, 'label' => $attendee->memberName];
        }
        return $ret;
    }

    public static function getAttendeeRooms($idEvent, $aftersend, &$numattendees) {
    	// Asumimos que el evento es de viernes a domingo
	    $ev = Event::findOne($idEvent);
	    $friday = $ev->dateStart;
	    $wednesday = DateFunctions::dateAdd($friday, -2);
	    $thursday = DateFunctions::dateAdd($friday, -1);
	    $saturday = DateFunctions::dateAdd($friday, 1);
	    $sunday = $ev->dateEnd;

	    $rooms = [];
	    $attq = Attendee::find()->andFilterEvent($idEvent)->andFilterLodging();
	    $attendees = $attq->all();
	    $numattendees = count ($attendees);
	    $roommates = [];
	    $roomindex = 0;
	    foreach ($attendees as $attendee) {
	    	$roompos = -1;
	    	if (strlen ($attendee->idAttendeeRoommate1) && isset ($roommates[$attendee->idAttendeeRoommate1]) ) $roompos = $roommates[$attendee->idAttendeeRoommate1];
		    if (strlen ($attendee->idAttendeeRoommate2) && isset ($roommates[$attendee->idAttendeeRoommate2]) ) $roompos = $roommates[$attendee->idAttendeeRoommate2];
		    if (strlen ($attendee->idAttendeeRoommate3) && isset ($roommates[$attendee->idAttendeeRoommate3]) ) $roompos = $roommates[$attendee->idAttendeeRoommate3];
		    if ($roompos != -1) {
		    	$roomp = $roompos;
		    	$rooms[$roompos]->names[] = $attendee->name;
		    	$rooms[$roompos]->surnames[] = $attendee->surname;
			    $rooms[$roompos]->nifs[] = $attendee->nif;
			    $rooms[$roompos]->parking[] = $attendee->parkingReservation;
			    $rooms[$roompos]->remarks .= ' ' . $attendee->remarksHotel;
			    $rooms[$roompos]->wednesday |= ($attendee->dateStartLodging <= $wednesday);
			    $rooms[$roompos]->thursday |= ($attendee->dateStartLodging <= $thursday);
			    $rooms[$roompos]->friday |= ($attendee->dateStartLodging <= $friday) && ($attendee->dateEndLodging > $friday);
			    $rooms[$roompos]->saturday |= ($attendee->dateStartLodging <= $saturday) && ($attendee->dateEndLodging > $saturday);
			    $rooms[$roompos]->sunday |= ($attendee->dateStartLodging <= $sunday) && ($attendee->dateEndLodging > $sunday);
		    } else {
			    $roomp = $roomindex;
		    	$rooms[$roomindex] = new \stdClass();
			    $rooms[$roomindex]->names = [$attendee->name];
			    $rooms[$roomindex]->surnames = [$attendee->surname];
			    $rooms[$roomindex]->nifs = [$attendee->nif];
			    $rooms[$roomindex]->parking = [$attendee->parkingReservation];
			    $rooms[$roomindex]->status = $attendee->status;
			    $rooms[$roomindex]->roomType = $attendee->getRoomTypeValue();
			    $rooms[$roomindex]->remarks = $attendee->remarksHotel;
			    $rooms[$roomindex]->wednesday = ($attendee->dateStartLodging <= $wednesday);
			    $rooms[$roomindex]->thursday = ($attendee->dateStartLodging <= $thursday);
			    $rooms[$roomindex]->friday = ($attendee->dateStartLodging <= $friday) && ($attendee->dateEndLodging > $friday);
			    $rooms[$roomindex]->saturday = ($attendee->dateStartLodging <= $saturday) && ($attendee->dateEndLodging > $saturday);
			    $rooms[$roomindex]->sunday = ($attendee->dateStartLodging <= $sunday) && ($attendee->dateEndLodging > $sunday);

			    $roommates[$attendee->id] = $roomindex;
			    $roomindex++;
		    }
			if ($aftersend && ($rooms[$roomp]->status != '2') && ($attendee->updatedAtHotel > $ev->dateSentInfoHotel) ) $rooms[$roomp]->status = '4';
	    }

	    return $rooms;
	}

    public static function getParkingReservations ($idEvent) {
        $attq = Attendee::find()->andFilterEvent($idEvent)->andFilterParking();
        $attendees = $attq->all();

        $parkingReservations = ['total' => count ($attendees)];
        foreach ($attendees as $attendee) {
            if ($attendee->parkingOptions != '') {
                if (isset ($parkingReservations[$attendee->parkingOptions])) {
                    $parkingReservations[$attendee->parkingOptions]++;
                } else {
                    $parkingReservations[$attendee->parkingOptions] = 1;
                }
            }
        }
        return $parkingReservations;
    }

	public static function getRoomDays ($attendeerooms) {
		$roomdays = new \stdClass();
		$roomdays->wednesday = 0;
		$roomdays->thursday = 0;
		$roomdays->friday = 0;
		$roomdays->saturday = 0;
		$roomdays->sunday = 0;

		foreach ($attendeerooms as $attendeeroom) {
		    if ($attendeeroom->status != '2') {
                if ($attendeeroom->wednesday) $roomdays->wednesday++;
                if ($attendeeroom->thursday) $roomdays->thursday++;
                if ($attendeeroom->friday) $roomdays->friday++;
                if ($attendeeroom->saturday) $roomdays->saturday++;
                if ($attendeeroom->sunday) $roomdays->sunday++;
            }
		}

		return $roomdays;
	}

	/**
	 * @deprecated
	 * @param $idEvent
	 *
	 * @return array
	 */
	public static function getAttendeeIncomes ($idEvent) {
		$guests = Attendee::getGuests($idEvent);

		$attq = Attendee::find()->andFilterEvent($idEvent)->confirmed();
		$attendees = $attq->all();

		// Asumimos que el evento es de viernes a domingo
		$ev = Event::findOne($idEvent);
		$friday = $ev->dateStart;
		$thursday = DateFunctions::dateAdd($friday, -1);
		$saturday = DateFunctions::dateAdd($friday, 1);
		$sunday = $ev->dateEnd;

		$incomes = array(
			'doubleFSDinners' => 0,
			'singleFSDinners' => 0,
			'tripleFSDinners' => 0,
			'doubleSDinners' => 0,
			'singleSDinners' => 0,
			'tripleSDinners' => 0,
			'doubleExtraDays' => 0,
			'singleExtraDays' => 0,
			'tripleExtraDays' => 0,
			'fridayDinners' => 0,
			'saturdayLunches' => 0,
			'saturdayDinners' => 0,
			'sundayLunches' => 0,
			'sundayDinners' => 0,
			'dayPasses' => 0,
			'saturdayPasses' => 0,
			'weekendPasses' => 0,
		);
		$gi = 1;
		foreach ($guests as $guest) {
			if ($guest->hasPhotoshoot) $incomes['photo'.$gi] = 0;
			if ($guest->hasAutograph) $incomes['signature'.$gi] = 0;
			if ($guest->hasVintage) $incomes['vintage'.$gi] = 0;
			//echo $guest->name.' - '.$gi .' - '.$guest->hasVintage;
			$gi++;
		}
		foreach ($attendees as $attendee) {
			$lodging = (strlen ($attendee->roomType) && ($attendee->status != '2') && !$attendee->freeLodging) ;
			$friSat = ( ($attendee->dateStartLodging <= $friday) && ($attendee->dateEndLodging >= $sunday) );
			$FSDinners = ($attendee->mealFridayDinner && $attendee->mealSaturdayDinner && !$attendee->freeSaturdayDinner);
			$sat = !$friSat && ( ($attendee->dateStartLodging <= $saturday) && ($attendee->dateEndLodging >= $sunday) );
			$thurs = ($attendee->dateStartLodging < $friday);
			//if ($thurs) echo "<li>".$attendee->dateStartLodging.' <= ' . $friday;
			$sun = ($attendee->dateEndLodging > $sunday);
			$single = ( ($attendee->roomType == 'I') || ($attendee->roomType == '1')  || ($attendee->roomType == 'U') );
			$double = ( ($attendee->roomType == 'D') || ($attendee->roomType == '2') || ($attendee->roomType == 'S')  || ( ($attendee->roomType == 'N') && !strlen ($attendee->idAttendeeParent)) );
			$triple = ($attendee->roomType == 'T') || ( ($attendee->roomType == '4') && !strlen ($attendee->idAttendeeParent) );
			$quadruple = ($attendee->roomType == 'Q');
			$lodgingChild = ( ($attendee->roomType == 'N') || ($attendee->roomType == '4') ) && strlen ($attendee->idAttendeeParent);

			if ($lodging && $friSat && $FSDinners && $double) $incomes['doubleFSDinners']++;
			elseif ($lodging && $friSat && $FSDinners && $single) $incomes['singleFSDinners']++;
			elseif ($lodging && $friSat && $FSDinners && $triple) $incomes['tripleFSDinners']++;
			elseif ($lodging && $friSat && $FSDinners && $quadruple) $incomes['quadrupleFSinners']++;

			if ($lodging && $sat && $attendee->mealSaturdayDinner && $double) $incomes['doubleSDinners']++;
			elseif ($lodging && $sat && $attendee->mealSaturdayDinner && $single) $incomes['singleSDinners']++;
			elseif ($lodging && $sat && $attendee->mealSaturdayDinner && $triple) $incomes['tripleSDinners']++;
			elseif ($lodging && $sat && $attendee->mealSaturdayDinner && $quadruple) $incomes['quadrupleSDinners']++;

			// Días extra
			if ($lodging && $friSat && !$FSDinners && $double) $incomes['doubleExtraDays'] += 2;
			elseif ($lodging && $friSat && !$FSDinners && $single) $incomes['singleExtraDays'] += 2;
			elseif ($lodging && $friSat && !$FSDinners && $triple) $incomes['tripleExtraDays'] += 2;
			elseif ($lodging && $friSat && !$FSDinners && $quadruple) $incomes['quadrupleExtraDays'] += 2;

			if ($lodging && $sat && !$attendee->mealSaturdayDinner && $double) $incomes['doubleExtraDays']++;
			elseif ($lodging && $sat && !$attendee->mealSaturdayDinner && $single) $incomes['singleExtraDays']++;
			elseif ($lodging && $sat && !$attendee->mealSaturdayDinner && $triple) $incomes['tripleExtraDays']++;
			elseif ($lodging && $sat && !$attendee->mealSaturdayDinner && $quadruple) $incomes['quadrupleExtraDays']++;

			if ($lodging && $thurs && $double) $incomes['doubleExtraDays']++;
			elseif ($lodging && $thurs && $single) $incomes['singleExtraDays']++;
			elseif ($lodging && $thurs && $triple) $incomes['tripleExtraDays']++;
			elseif ($lodging && $thurs && $quadruple) $incomes['quadrupleExtraDays']++;

			if ($lodging && $sun && $double) $incomes['doubleExtraDays']++;
			elseif ($lodging && $sun && $single) $incomes['singleExtraDays']++;
			elseif ($lodging && $sun && $triple) $incomes['tripleExtraDays']++;
			elseif ($lodging && $sun && $quadruple) $incomes['quadrupleExtraDays']++;

			// Cenas, comidas
			if (!$lodging && $attendee->mealSaturdayDinner && !$attendee->freeSaturdayDinner) $incomes['saturdayDinners']++;
			if (!$lodging && $attendee->mealFridayDinner) $incomes['fridayDinners']++;
			if ($lodgingChild && $attendee->mealSaturdayDinner) $incomes['saturdayDinners']++;
			if ($lodgingChild && $attendee->mealFridayDinner) $incomes['fridayDinners']++;

			if ($attendee->mealSaturdayLunch) $incomes['saturdayLunches']++;
			if ($attendee->mealSundayLunch) $incomes['sundayLunches']++;
			if ($attendee->mealSundayDinner) $incomes['sundayDinners']++;

			// Entradas
			if ( ($attendee->sourceName == 'Tienda') || ($attendee->sourceName == 'Reserva directa')) {
				if  (($attendee->ticketType == 'V') || ($attendee->ticketType == 'D') ) $incomes['dayPasses']++;
				elseif ($attendee->ticketType == 'S') $incomes['saturdayPasses']++;
				elseif ($attendee->ticketType == 'F') $incomes['weekendPasses']++;
			}

			// Fotos, firmas, cartones
			$gi = 1;
			foreach ($guests as $guest) {
				if ($guest->hasPhotoshoot && ($attendee->{'guest'.$gi.'Photoshoot'} > 0) ) $incomes['photo'.$gi] += $attendee->{'guest'.$gi.'Photoshoot'};
				if ($guest->hasPhotoshootSpecial && ($attendee->{'guest'.$gi.'PhotoshootSpecial'} > 0) ) $incomes['photoSpecial'.$gi] += $attendee->{'guest'.$gi.'PhotoshootSpecial'};
				if ($guest->hasAutograph && ($attendee->{'guest'.$gi.'Autograph'} > 0) ) $incomes['signature'.$gi] += $attendee->{'guest'.$gi.'Autograph'};
				if ($guest->hasVintage && ($attendee->{'guest' . $gi . 'Vintage'} > 0) ) $incomes[ 'vintage' . $gi ] += $attendee->{'guest' . $gi . 'Vintage'};
				$gi++;
			}
		}
		return $incomes;
	}

	public static function checkErrors($idEvent) {
		$attendees = Attendee::find()->andFilterEvent($idEvent)->all();

		$badgenames = [];
		$errors = [];
		/*foreach ($attendees as $attendee) {
			$attmap[$attendee->id] = $attendee;
		}*/
		$singleRooms = ['I', '1', 'U'];
		$doubleRooms = ['D', '2', 'S'];
		$tripleRooms = ['N', 'T'];
		$cuadrupleRooms = ['4', 'Q'];
		foreach ($attendees as $attendee) {
			if (strlen ($attendee->idAttendeeParent) && !strlen ($attendee->parentPhone)) {
				$errors[] = 'Padre no tiene teléfono: <a href="'.Url::to(['member/update', 'id' => $attendee->memberParentId]).'">' . $attendee->getParentName() . '</a>';
			}
			$badgename = $attendee->getMemberName();
			if (isset ($badgenames[$badgename])) {
				$errors[] = 'Nombre de asistente duplicado: <a href="'.Url::to(['attendee/update', 'id' => $attendee->id]).'">' . $badgename . '</a>';
			} else {
				$badgenames[$badgename] = '1';
			}

			$hasRoomType = strlen ($attendee->roomType)? true: false;
			$hasDateStartLodging = strlen ($attendee->dateStartLodging)? true: false;
			$hasDateEndLodging = strlen ($attendee->dateEndLodging)? true: false;
			$hasRoommate1 = strlen ($attendee->idAttendeeRoommate1)? true: false;
			$hasRoommate2 = strlen ($attendee->idAttendeeRoommate2)? true: false;
			$hasRoommate3 = strlen ($attendee->idAttendeeRoommate3)? true: false;
			if ( ($hasRoomType && !$hasDateStartLodging) || ($hasRoomType && !$hasDateEndLodging) || ($hasDateStartLodging && !$hasRoomType) || ($hasDateEndLodging && !$hasRoomType)
			     || ($hasDateStartLodging && !$hasDateEndLodging) || ($hasDateEndLodging && !$hasDateStartLodging) || ($hasRoommate1 && !$hasRoomType) || ($hasRoommate2 && !$hasRoomType)
			     || ($hasRoommate1 && !$hasDateStartLodging) || ($hasRoommate2 && !$hasDateStartLodging) || ($hasRoommate1 && !$hasDateEndLodging) || ($hasRoommate2 && !$hasDateEndLodging) ) {
				$errors[] = 'Datos de alojamiento incompletos: <a href="'.Url::to(['attendee/update', 'id' => $attendee->id]).'">' . $badgename . '</a>';
			}
			if ( (in_array ($attendee->roomType, $singleRooms) && ($hasRoommate1 || $hasRoommate2) ) || (in_array ($attendee->roomType, $doubleRooms) && (!$hasRoommate1 || $hasRoommate2) )
		         || (in_array ($attendee->roomType, $tripleRooms) && (!$hasRoommate1 || !$hasRoommate2) ) || (in_array ($attendee->roomType, $cuadrupleRooms) && (!$hasRoommate1 || !$hasRoommate2 || !$hasRoommate3) ) ) {
				$errors[] = 'Datos de alojamiento inconsistentes - tipo de habitación no corresponde con compañeros: <a href="'.Url::to(['attendee/update', 'id' => $attendee->id]).'">' . $badgename . '</a>';
			}
			if  ( ($attendee->mealSaturdayDinner && !strlen ($attendee->remarksMealSaturday) )|| (!$attendee->mealSaturdayDinner && strlen ($attendee->remarksMealSaturday) ) ) {
				$errors[] = 'Datos de cena de gala inconsistentes: <a href="'.Url::to(['attendee/update', 'id' => $attendee->id]).'">' . $badgename . '</a>';
			}
		}
		return $errors;
	}
}
