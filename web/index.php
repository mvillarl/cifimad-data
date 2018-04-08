<?php

$_prod = ($_SERVER['HTTP_HOST'] == 'data.cifimad.es');
$_ppe = ($_SERVER['HTTP_HOST'] == 'datatest.cifimad.es');
if (!$_prod) {
	// comment out the following two lines when deployed to production
	defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
	defined( 'YII_ENV' ) or define( 'YII_ENV', 'dev' );
}
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
