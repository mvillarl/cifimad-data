<?php
namespace app\models;

use yii\db\ActiveQuery;

class WPUserQuery extends ActiveQuery {
	public function __construct( $modelClass, array $config = null) {
		parent::__construct( $modelClass, $config );
		$this->leftJoin('wp_usermeta mbn', "wp_users.id = mbn.user_id AND mbn.meta_key = 'billing_nif'")
		->leftJoin('wp_usermeta msn', "wp_users.id = msn.user_id AND msn.meta_key = 'shipping_nif'")
		->leftJoin('wp_usermeta mbp', "wp_users.id = mbp.user_id AND mbp.meta_key = 'billing_phone'")
		->leftJoin('wp_usermeta msp', "wp_users.id = msp.user_id AND msp.meta_key = 'shipping_phone'")
		->leftJoin('wp_usermeta mfn', "wp_users.id = mfn.user_id AND mfn.meta_key = 'first_name'")
		->leftJoin('wp_usermeta mln', "wp_users.id = mln.user_id AND mln.meta_key = 'last_name'")->distinct()
		     ->select(['wp_users.id', 'mfn.meta_value firstname', 'mln.meta_value lastname', 'wp_users.user_email', 'wp_users.user_status', 'mbn.meta_value bdni', 'msn.meta_value sdni', 'mbp.meta_value bphone', 'msp.meta_value sphone'])
		     //->andWhere('ps2_customer.active = 1 and ps2_address.active = 1')
		;
	}

	public function modifiedAfter($date = '')
	{
		$ret = $this;
		if (strlen ($date)) $ret = $ret->andWhere (['>', 'wp_users.user_registered', $date]);
		return $ret;
	}
}