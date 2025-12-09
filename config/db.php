<?php

$_dbhost ='localhost'; // $_prod || $_ppe? 'rdbms.strato.de': 'localhost';
if ($_ppe) {
    $_dbname = 'DB1438945';
    $_dbuser = 'U1438945';

} elseif ($_prod) {
    $_dbname = 'u912014495_DB2627984';
    $_dbuser = 'u912014495_U2627984';
} else {
    $_dbname = 'DB2627984';
    $_dbuser = 'U2627984';
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$_dbhost.';dbname='.$_dbname,
    'username' => $_dbuser,
    'password' => 'vR3ntH5pFn',
    'charset' => 'utf8',
];
