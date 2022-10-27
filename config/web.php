<?php
//ini_set ('display_errors', 'On');
define('YII_DEBUG', true);

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => $_ppe? 'datatest.cifimad.es': 'data.cifimad.es',
    'name' => 'CifiMad - Data' . ($_ppe? ' - Test': ''),
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '9k1yRHkVWC4-ownKzT4JOg5O7ee6bASv',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],*/
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'dbtienda' => require(__DIR__ . '/dbtienda.php'),
        'dbwordpress' => require(__DIR__ . '/dbwordpress.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/member/loadfromps/<filter>' => 'member/loadfromps',
                '/member/export/<onlydni>' => 'member/export',
                '/member/ajaxsearch/<term>' => 'member/ajaxsearch',
                '/member/consent/<key>/<email>' => 'member/consent',
                '/attendee/ajaxsearch/<term>' => 'attendee/ajaxsearch',
                '/attendee/reportbadgelabels/<afterprint>' => 'attendee/reportbadgelabels',
                '/attendee/reportbadgelabels/<afterprint>/<showinfotickets>' => 'attendee/reportbadgelabels',
                '/attendee/reporttickets/<afterprint>' => 'attendee/reporttickets',
                '/attendee/reporthotel/<aftersend>' => 'attendee/reporthotel',
                '/attendee/reportbadges/<detailed>' => 'attendee/reportbadges',
                '/attendee/reportreservations/<detailed>' => 'attendee/reportreservations',
                '/attendee/reportparking/<flag>' => 'attendee/reportparking',
                '/attendee/ajaxsavemark/<id>/<done>' => 'attendee/ajaxsavemark',
                '/press/export/<consent>' => 'press/export',
                '/press/consent/<key>/<email>' => 'press/consent',
                '/poll/vote/<key>' => 'poll/vote',
                '/poll/result/<key>' => 'poll/result',
            ],
        ],
    ],
    'params' => $params,
    'defaultRoute' => '/attendee/index',
    //'defaultRoute' => '/event/index',
    'language' => 'es-ES',
    'on beforeAction'=>function(yii\base\ActionEvent $event) {
        if ( in_array ($event->action->uniqueId, array ('member/export', 'press/export') ) )
        {
            $event->action->controller->layout = 'excelLayout.php';
        };
        if ( in_array ($event->action->uniqueId, array ('attendee/reportbadgelabels', 'attendee/reportbadges', 'attendee/reporthotel', 'attendee/reportincomes', 'attendee/reportreservations', 'attendee/reportcifikids', 'attendee/reportparking', 'attendee/reporttickets', 'cosplayinscription/report', 'volunteer-inscription/report') ) )
        {
            $event->action->controller->layout = 'reportLayout.php';
        };
        if ( in_array ($event->action->uniqueId, array ('member/consent', 'press/consent', 'cosplayinscription/signup', 'volunteer-inscription/signup', 'poll/vote', 'poll/result') ) )
        {
            $event->action->controller->layout = 'publicLayout.php';
        };
        if ( in_array ($event->action->uniqueId, array ('member/ajaxSearch', 'attendee/ajaxSearch') ) )
        {
            $event->action->controller->layout = null;
        };
        // Aquí? obligar a cambiar contraseña
        if ( ($event->action->uniqueId != 'user-management/auth/change-own-password') && Yii::$app->user->forcechangepassword) {
            $event->action->controller->redirect('/user-management/auth/change-own-password');
        }
    },
    'modules'=>[
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',

             //'enableRegistration' => true,
             'enableRecovery' => true,

            // Here you can set your handler to change layout for any controller or action
            // Tip: you can use this event in any module
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( in_array ($event->action->uniqueId, array ('user-management/auth/login'/*, 'user-management/auth/password-recovery'*/) ) )
                {
                    $event->action->controller->layout = 'loginLayout.php';
                };
                // Aquí? obligar a cambiar contraseña
                if ( ($event->action->uniqueId != 'user-management/auth/change-own-password') && Yii::$app->user->forcechangepassword) {
                    $event->action->controller->redirect('user-management/auth/change-own-password');
                }
            },
        ],
        'redactor' => 'yii\redactor\RedactorModule',
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
