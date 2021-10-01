<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AttendeeSale */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Registrar ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attendee-sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'ATENCIÓN: ¿Seguro que quieres borrar esta venta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'eventName',
                'format' => 'raw',
                'value'=> $model->eventName,
            ],
            'name',
            'phone',
            [
                'attribute' => 'ticketType',
                'value' => $model->getTicketTypeValue(),
            ],
            [
                'attribute' => 'vaccine',
                'value' => $model->getVaccineValue(),
            ],
            'authorizedBy',
            'authorizedReason',
        ],
    ]) ?>

</div>
