<?php
namespace app\models;

use yii\db\ActiveQuery;

class PS2CustomerQuery extends ActiveQuery {
	public function __construct( $modelClass, array $config = null) {
		parent::__construct( $modelClass, $config );
		$this->innerJoin('ps2_address', 'ps2_customer.id_customer = ps2_address.id_customer')->distinct()
			->select(['ps2_customer.id_customer', 'ps2_customer.firstname', 'ps2_customer.lastname', 'ps2_customer.email', 'ps2_customer.active', 'ps2_address.dni', 'ps2_address.phone_mobile'])
			->andWhere('ps2_customer.active = 1 and ps2_address.active = 1');
	}

	public function modifiedAfter($date = '')
	{
		$ret = $this;
		if (strlen ($date)) $ret = $ret->andWhere (['or', ['>', 'ps2_customer.date_upd', $date] , ['>', 'ps2_address.date_upd', $date] ]);
		return $ret;
	}
}