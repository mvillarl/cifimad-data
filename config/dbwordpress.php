<?php

$_dbhost ='localhost'; // $_prod || $_ppe? 'rdbms.strato.de': 'localhost';

/* Datos antiguos (CifiMad y Fanvención hasta 2022)
 * return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname=DB3060401',
	'username' => 'U3060401',
	'password' => 'cifi159mad753',
	'charset' => 'utf8',
];*/
if ($_prod) {
    $_db = 'u912014495_dbs2637510';
    $_user = 'u912014495_dbs2637510';
} else {
    $_db = 'dbs2637510';
    $_user = 'dbu2416116';
}
return [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host='.$_dbhost.';dbname='.$_db,
	'username' => $_user,
	'password' => 'XKEgFDet*xf7YVF', // Antigua 3KLupBDn7qX7y2m
	'charset' => 'utf8',
];
