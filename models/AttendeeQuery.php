<?php

namespace app\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Attendee]].
 *
 * @see Attendee
 */
class AttendeeQuery extends \yii\db\ActiveQuery
{
    public function __construct( $modelClass, array $config = null) {
        parent::__construct( $modelClass, $config );
        $this->joinWith('idEvent0')->joinWith('idMember0')->joinWith('idSource0')
            ->leftJoin('cif_attendees roommate1', 'cif_attendees.idAttendeeRoommate1 = roommate1.id')
            ->leftJoin('cif_members memberRoommate1', 'roommate1.idMember = memberRoommate1.id')
            ->leftJoin('cif_attendees roommate2', 'cif_attendees.idAttendeeRoommate2 = roommate2.id')
            ->leftJoin('cif_members memberRoommate2', 'roommate2.idMember = memberRoommate2.id')
            ->leftJoin('cif_attendees roommate3', 'cif_attendees.idAttendeeRoommate3 = roommate3.id')
            ->leftJoin('cif_members memberRoommate3', 'roommate3.idMember = memberRoommate3.id')
            ->leftJoin('cif_attendees parent', 'cif_attendees.idAttendeeParent = parent.id')
            ->leftJoin('cif_members memberParent', 'parent.idMember = memberParent.id')
            ->select('cif_attendees.*, cif_events.name eventName, cif_members.badgeName, cif_members.badgeSurname, cif_members.name, cif_members.surname, cif_sources.name sourceName, cif_members.nif, cif_members.small memberSmall'
                     . ', memberRoommate1.badgeName roommate1BadgeName, memberRoommate1.badgeSurname roommate1BadgeSurname'
                     . ', memberRoommate2.badgeName roommate2BadgeName, memberRoommate2.badgeSurname roommate2BadgeSurname'
                     . ', memberRoommate3.badgeName roommate3BadgeName, memberRoommate3.badgeSurname roommate3BadgeSurname'
                     . ', memberParent.id memberParentId, memberParent.badgeName parentBadgeName, memberParent.badgeSurname parentBadgeSurname, memberParent.phone parentPhone');
    }

    public function andFilterSearchMember ($term) {
        $term = trim($term);
        if (strlen ($term)) {
            $this->andWhere(['or', 'cif_members.badgeName LIKE :term', 'cif_members.badgeSurname LIKE :term', 'cif_members.name LIKE :term', 'cif_members.surname LIKE :term', 'cif_members.nif LIKE :term'], [':term' => '%'.$term.'%']);
        }
        return $this;
    }

	public function andFilterEvent ($idEvent) {
		return $this->andWhere ('cif_attendees.idEvent = :event', ['event' => $idEvent] );
	}

	public function andFilterLodging() {
		return $this->andWhere("cif_attendees.roomType IS NOT NULL AND cif_attendees.status <> '3'")->orderBy('cif_members.surname, cif_members.name');
	}

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function andCocktail() {
	    //return $this->andWhere('cif_attendees.mealFridayDinner = true')->orderBy ('cif_members.surname, cif_members.name');
	    return $this->andWhere('cif_attendees.mealFridayDinner = true')->orderBy ('cif_members.badgeName, cif_members.badgeSurname');
    }

    public function andGala() {
	    //return $this->andWhere('cif_attendees.mealSaturdayDinner = true')->orderBy ('cif_members.surname, cif_members.name');
	    return $this->andWhere('cif_attendees.mealSaturdayDinner = true')->orderBy ('cif_members.badgeName, cif_members.badgeSurname');
    }

    public function andSaturdayLunch() {
	    return $this->andWhere('cif_attendees.mealSaturdayLunch = true')->orderBy ('cif_members.badgeName, cif_members.badgeSurname');
    }

    public function andSundayLunch() {
	    return $this->andWhere('cif_attendees.mealSundayLunch = true')->orderBy ('cif_members.badgeName, cif_members.badgeSurname');
    }

    public function andSundayDinner() {
	    return $this->andWhere('cif_attendees.mealSundayDinner = true')->orderBy ('cif_members.badgeName, cif_members.badgeSurname');
    }
    /**
     * @inheritdoc
     * @return Attendee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Attendee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function confirmed() {
        $this->andWhere("cif_attendees.status = '1' OR cif_attendees.status = '2'");
        return $this;
    }

    public function notCanceled() {
        $this->andWhere("cif_attendees.status <> '3'");
        return $this;
    }

    public function orderBadgeLabelReport() {
        return $this->addSelect (new Expression ("IF(cif_attendees.idSource = '2', 1, 2) isStaff") )->addSelect (new Expression ("CASE cif_attendees.ticketType WHEN 'V' THEN 1 WHEN 'S' THEN 2 WHEN 'D' THEN 3 WHEN 'F' THEN 4 END ticketTypeOrder") )
	        ->addSelect ('cif_sources.imageFile sourceImageFile')
            ->andWhere("cif_attendees.ticketType <> '-'")
            //->orderBy('isSpecial DESC, isStaff, ticketTypeOrder, cif_members.badgeSurname, cif_members.badgeName');
            ->orderBy('isSpecial DESC, isStaff, ticketTypeOrder, cif_members.badgeName, cif_members.badgeSurname');
    }

	public function orderBadgeReport($detailed) {
		//return $this->andWhere("cif_attendees.ticketType <> '-'")->orderBy('cif_members.badgeSurname, cif_members.badgeName');
		$this->andWhere("cif_attendees.ticketType <> '-'");
        $order = 'cif_members.surname, cif_members.name';
		if ($detailed == 'D') {
			$maxGuests = 4;
			$maxExtraProd = 4;
			$whereProds = '';
			for ($i = 1; $i <= $maxGuests; $i++) {
				if (strlen ($whereProds) ) $whereProds .= ' OR ';
				$whereProds .= 'cif_attendees.guest'.$i.'Photoshoot <> 0 OR cif_attendees.guest'.$i.'PhotoshootSpecial <> 0 OR cif_attendees.guest'.$i.'Autograph <> 0 OR cif_attendees.guest'.$i.'Vintage <> 0' ;
			}
			for ($i = 1; $i <= $maxExtraProd; $i++) {
				if ( strlen( $whereProds ) ) $whereProds .= ' OR ';
				$whereProds .= 'cif_attendees.extraProduct'.$i.' <> 0';
				
			}
			$this->andWhere( $whereProds );
		} elseif ($detailed == 'A') {
            $this->andWhere(' cif_sources.separateList = 1');
            $order = 'cif_sources.name,cif_members.badgeName, cif_members.badgeSurname';
		} elseif ($detailed == 'M') {
            $this->andWhere(' cif_attendees.mealFridayDinner = true OR cif_attendees.mealSaturdayDinner = true OR cif_attendees.mealSaturdayLunch = true OR cif_attendees.mealSundayLunch = true OR cif_attendees.mealSundayDinner = true');
            $order = 'cif_members.badgeName, cif_members.badgeSurname';
        }
		$this->orderBy($order);
		return $this;
	}

    public function afterDate ($date, $part = '') {
    	if ($part == 'BadgesTickets') {
		    return $this->andWhere(['or', 'cif_attendees.updatedAtBadges > :date', 'cif_attendees.updatedAtBadgesTickets > :date'], ['date' => $date ]);
	    } else {
		    return $this->andWhere( 'cif_attendees.updatedAt' . $part . ' > :date', [ 'date' => $date ] );
	    }
    }

    public function andFilterOrders ($orders) {
	    $term = trim($orders);
	    if (strlen ($orders)) {
		    $this->andWhere('cif_attendees.orders LIKE :orders', [':orders' => '%'.$orders.'%']);
	    }
	    return $this;

	}
}
