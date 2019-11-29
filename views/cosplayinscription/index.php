<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CosplayInscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $events array */
/* @var $categories array */

$this->title = 'Inscripciones al concurso de cosplay';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cosplay-inscription-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Inscripción', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'idEvent',
                'filter'=>$events,
                'value'=>'eventName',
                'format'=>'raw',
            ],
            //'idEvent',
            'name',
            'surname',
            'email:email',
            [
                'attribute'=>'category',
                'filter'=>$categories,
                'value'=>'categoryValue',
                'format'=>'raw',
            ],
            //'category',
            //'characterName',
            //'remarks:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
