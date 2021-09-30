<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendeeSaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registrar ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendee-sale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar venta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'idEvent',
                'filter'=>$events,
                'format'=>'raw',
            ],
            'name',
            'phone',
            [
                'attribute'=>'ticketType',
                'filter'=>$ticketTypes,
                'format'=>'raw',
                'value' => function($model, $key, $index) {
                    return $model->getTicketTypeValue();
                }
            ],
            //'authorizedBy',
            //'authorizedReason',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
