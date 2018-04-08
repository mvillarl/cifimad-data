<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Guest */

$this->title = 'Modificar invitado: ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Invitados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="guest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
    ]) ?>

</div>
