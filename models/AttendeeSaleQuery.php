<?php


namespace app\models;


/**
 * This is the ActiveQuery class for [[AttendeeSale]].
 *
 * @see AttendeeSale
 */
class AttendeeSaleQuery extends \yii\db\ActiveQuery {

	public function andFilterHasAuthorization ($hasAuthorization) {
		if (strlen ($hasAuthorization)) {
			if ($hasAuthorization == '1') {
				$this->andWhere("authorizedBy IS NOT NULL AND TRIM(authorizedBy) <> '' ");
			} else {
				$this->andWhere("authorizedBy IS  NULL OR TRIM(authorizedBy) = '' ");
			}
		}
		return $this;
	}
}