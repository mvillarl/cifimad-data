<?php

$_dbhost = $_prod || $_ppe? 'rdbms.strato.de': 'localhost';

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname=DB1099658',
	'username' => 'U1099658',
	'password' => 'ST1701Picard',
	'charset' => 'utf8',
];
