<?php

namespace app\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[Attendee]].
 *
 * @see Attendee
 */
class CosplayInscriptionQuery extends \yii\db\ActiveQuery
{
    public function andFilterEvent ($idEvent) {
        return $this->andWhere ('cif_cosplay_inscriptions.idEvent = :event', ['event' => $idEvent] );
    }

	public function active() {
		return $this->andWhere ('cif_cosplay_inscriptions.status = true');
	}

    public function orderByCat() {
        return $this->orderBy ('category, createdAt');
    }
}
