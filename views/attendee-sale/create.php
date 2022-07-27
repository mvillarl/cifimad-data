<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AttendeeSale */

$this->title = 'Registrar nueva venta';
$this->params['breadcrumbs'][] = ['label' => 'Registrar ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendee-sale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
        'isPandemic' => $isPandemic,
    ]) ?>

</div>
