<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Medios de prensa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="press-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Miembro de prensa', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Exportar', ['export'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Exportar (sin consentimiento)', ['/press/export/0'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'idSource',
                'filter'=>$sources,
                'value'=>'sourceName',
                'format'=>'raw',
            ],
            'name',
            'email:email',
            [
                'attribute' => 'consent',
                'filter' => [
                    '0' => 'No',
                    '1' => 'Sí',
                ],
                'value' => 'consentName',
                'format'=>'raw',
            ],
            [
                'attribute' => 'status',
                'filter' => [
                    '0' => 'No',
                    '1' => 'Sí',
                ],
                'value' => 'statusName',
                'format'=>'raw',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
