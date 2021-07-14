<?php

namespace app\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Attendee]].
 *
 * @see Attendee
 */
class VolunteerInscriptionQuery extends \yii\db\ActiveQuery
{
	public function andFilterEvent ($idEvent) {
		return $this->andWhere ('cif_volunteer_inscriptions.idEvent = :event', ['event' => $idEvent] );
	}

	public function orderByName() {
		return $this->orderBy ('cif_volunteer_inscriptions.name');
	}
}
