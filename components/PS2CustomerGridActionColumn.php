<?php
namespace app\components;

use yii\grid\ActionColumn;

class PS2CustomerGridActionColumn extends ActionColumn {
	public function createUrl ( $action, $model, $key, $index ) {
		$url = parent::createURL ($action, $model, $key, $index );
		$url = preg_replace ('/id\=.*$/', 'id=' . $model->idMember, $url);
		return $url;
	}

}