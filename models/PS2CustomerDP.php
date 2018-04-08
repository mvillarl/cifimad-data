<?php
namespace app\models;

use yii\data\DataProviderInterface;

class PS2CustomerDP implements DataProviderInterface {
	protected $_customers;

	public function __construct ($customers) {
		$this->_customers = $customers;
	}

	public function getCount() {
		return count($this->_customers);
	}

	public function getKeys() {
		return array_keys($this->_customers);
	}

	public function getModels() {
		return $this->_customers;
	}

	public function getPagination() {
		return false;
	}

	public function getSort() {
		return false;
	}

	public function getTotalCount() {
		return count($this->_customers);
	}

	public function prepare( $forcePrepare = false ) {
		return;
	}

}