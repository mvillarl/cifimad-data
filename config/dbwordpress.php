<?php

$_dbhost = $_prod || $_ppe? 'rdbms.strato.de': 'localhost';

/* Datos antiguos (CifiMad y Fanvención hasta 2022)
 * return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname=DB3060401',
	'username' => 'U3060401',
	'password' => 'cifi159mad753',
	'charset' => 'utf8',
];*/
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname=dbs2637510',
	'username' => 'dbu2416116',
	'password' => '3KLupBDn7qX7y2m',
	'charset' => 'utf8',
];
