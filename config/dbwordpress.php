<?php

$_dbhost = $_prod || $_ppe? 'rdbms.strato.de': 'localhost';

return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname=DB3060401',
	'username' => 'U3060401',
	'password' => 'cifi159mad753',
	'charset' => 'utf8',
];
