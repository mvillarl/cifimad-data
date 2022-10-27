<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Poll;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PollSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Encuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Encuesta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pkey',
            'title',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Poll $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
