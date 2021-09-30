<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttendeeSale */

$this->title = 'Modificar venta: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Registrar ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="attendee-sale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
    ]) ?>

</div>