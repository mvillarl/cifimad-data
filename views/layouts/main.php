<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use webvimark\modules\UserManagement\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name . ' - ' . $this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'CifiMad',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]); ?>
    <img src="/img/banner.png"/>
    <?php
    $menuitems = [];
    if (User::canRoute('/event/index') || User::canRoute('/volunteer-inscription/index') ) {
        $menuitemsevents = [];
        if (User::canRoute('/event/index')) $menuitemsevents[] = ['label' => 'Eventos', 'url' => '/event/index'];
        if (User::canRoute('/guest/index')) $menuitemsevents[] = ['label' => 'Invitados', 'url' => '/guest/index'];
        if (User::canRoute('/companion/index')) $menuitemsevents[] = ['label' => 'Acompañantes', 'url' => '/companion/index'];
        if (User::canRoute('/source/index')) $menuitemsevents[] = ['label' => 'Procedencias', 'url' => '/source/index'];
        if (User::canRoute('/product/index')) $menuitemsevents[] = ['label' => 'Productos extra', 'url' => '/product/index'];
        if (User::canRoute('/press/index')) $menuitemsevents[] = ['label' => 'Prensa', 'url' => '/press/index'];
        if (User::canRoute('/cosplayinscription/index')) $menuitemsevents[] = ['label' => 'Inscripciones cosplay', 'url' => '/cosplayinscription/index'];
        if (User::canRoute('/cosplayinscription/report')) $menuitemsevents[] = ['label' => 'Inscripciones cosplay - informe', 'url' => '/cosplayinscription/report', 'linkOptions' => ['target' => 'blank'] ];
	    if (User::canRoute('/volunteer-inscription/index')) $menuitemsevents[] = ['label' => 'Inscripciones voluntarios', 'url' => '/volunteer-inscription/index'];
	    if (User::canRoute('/volunteer-inscription/report')) $menuitemsevents[] = ['label' => 'Inscripciones voluntarios - informe', 'url' => '/volunteer-inscription/report'];
	    if (User::canRoute('/poll/index')) $menuitemsevents[] = ['label' => 'Encuestas', 'url' => '/poll/index'];
	    if (User::canRoute('/poll-answer/index')) $menuitemsevents[] = ['label' => 'Encuestas - respuestas', 'url' => '/poll-answer/index'];
        $menuitems[] = ['label' => 'Base','items' => $menuitemsevents];
    }
    if (User::canRoute('/member/index')) $menuitems[] = ['label' => 'Socios', 'url' => '/member/index'];
    if (User::canRoute('/attendee/index')) {
        if (User::hasRole ('desk', false)) {
            $menuitemsatt = null;
        } else {
            $menuitemsatt = [
                ['label' => 'Asistentes', 'url' => '/attendee/index'],
                ['label' => 'Informe - etiquetas', 'url' => '/attendee/reportbadgelabels', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - etiquetas - después de primera impresión', 'url' => '/attendee/reportbadgelabels/A', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - etiquetas - después de primera impresión - info tickets', 'url' => '/attendee/reportbadgelabels/A/T', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - etiquetas - con tarjetas', 'url' => '/attendee/reportbadgelabels/0/B', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - acreditaciones', 'url' => '/attendee/reportbadges', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - acreditaciones - fotos, firmas, cartones', 'url' => '/attendee/reportbadges/D', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - acreditaciones - asociaciones', 'url' => '/attendee/reportbadges/A', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - hotel', 'url' => '/attendee/reporthotel', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - hotel - después de primer envío', 'url' => '/attendee/reporthotel/A', 'linkOptions' => ['target' => 'blank']],
                //['label' => 'Informe - cenas y comidas', 'url' => '/attendee/reporthotel/M', 'linkOptions' => ['target' => 'blank'] ],
                ['label' => 'Informe - cenas y comidas', 'url' => '/attendee/reportbadges/M', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - tickets', 'url' => '/attendee/reporttickets', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - tickets - después de primera impresión', 'url' => '/attendee/reporttickets/A', 'linkOptions' => ['target' => 'blank']],
                //['label' => 'Informe - cuentas', 'url' => '/attendee/reportincomes', 'linkOptions' => ['target' => 'blank'] ],
                ['label' => 'Informe - reservas', 'url' => '/attendee/reportreservations', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - CifiKids', 'url' => '/attendee/reportcifikids', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - Reservas de aparcamiento', 'url' => '/attendee/reportparking', 'linkOptions' => ['target' => 'blank']],
                ['label' => 'Informe - Reservas de aparcamiento - hotel', 'url' => '/attendee/reportparking/H', 'linkOptions' => ['target' => 'blank']],
            ];
        }
        $menuitems[] = ['label' => 'Asistentes', 'url' => '/attendee/index', 'items' => $menuitemsatt];
    }
    if (User::canRoute('/attendee-sale/index')) {
        $menuitems[] = ['label' => 'Registrar ventas', 'url' => '/attendee-sale/index'];
    }
    if (User::canRoute('/event/help')) {
        $menuitems[] = ['label' => 'Ayuda acreditaciones', 'url' => '/event/help'];
    }
    if (User::canRoute('/user-management/user/index')) {
        $menuitemsuser = [ ['label' => 'Usuarios', 'url' => '/user-management/user/index'] ];
        if (User::canRoute('/user-management/role/index') ) $menuitemsuser[] = ['label' => 'Roles', 'url' => '/user-management/role/index'];
        if (User::canRoute('/user-management/permission/index') ) $menuitemsuser[] = ['label' => 'Permisos', 'url' => '/user-management/permission/index'];
        if (User::canRoute('/user-management/auth-item-group/index') ) $menuitemsuser[] = ['label' => 'Grupos de permisos', 'url' => '/user-management/auth-item-group/index'];
        if (User::canRoute('/user-management/user-visit-log/index') ) $menuitemsuser[] = ['label' => 'Registro de visitas', 'url' => '/user-management/user-visit-log/index'];

        $menuitems[] = ['label' => 'Gestión de usuarios', 'items' => $menuitemsuser];
    }
    if (YII_ENV_DEV && User::canRoute('/gii')) $menuitems[] = ['label' => 'Gii', 'url' => '/gii'];
    if (Yii::$app->user->isGuest) {
        $menuitems[] = [ 'label' => 'Login', 'url' => [ '/site/login' ] ];
    } else {
        $menuitems[] = [ 'label' => 'Cambiar contraseña', 'url' => [ '/user-management/auth/change-own-password' ] ];
        $menuitems[] = '<li>'
           . Html::beginForm( [ '/user-management/auth/logout' ], 'post', [ 'class' => 'navbar-form' ] )
           . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                [ 'class' => 'btn btn-link' ]
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuitems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; CifiMad <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
