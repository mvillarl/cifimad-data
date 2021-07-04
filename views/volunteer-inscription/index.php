<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VolunteerInscriptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $events array */

$this->title = 'Inscripciones de voluntarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-inscription-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Crear Inscripción de voluntario', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            'email:email',
            'nameFacebook',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
