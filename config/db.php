<?php

$_dbhost = $_prod || $_ppe? 'rdbms.strato.de': 'localhost';
$_dbname = $_ppe? 'DB1438945': 'DB2627984';
$_dbuser = $_ppe? 'U1438945': 'U2627984';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$_dbhost.';dbname='.$_dbname,
    'username' => $_dbuser,
    'password' => 'vR3ntH5pFn',
    'charset' => 'utf8',
];
