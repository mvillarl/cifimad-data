<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SourceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procedencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $yesno = ['0' => 'No', '1' => 'Sí']; // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear procedencia', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cargar procedencias', ['load'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute' => 'status',
                'filter' => ['0' => 'No', '1' => 'Sí'],
                'format' => 'raw',
                'value' => function($model, $key, $index) {

                    return $model->getStatusValue();
                }

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
