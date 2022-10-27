<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\PollAnswer;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PollAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $polls app\models\Poll[] */

$this->title = 'Encuestas - respuestas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear respuesta a encuesta', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'idPoll',
                'filter'=>$polls,
                'value'=>'pollKey',
                'format'=>'raw',
            ],
            //'idPoll',
            'answerText',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, PollAnswer $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
