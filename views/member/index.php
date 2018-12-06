<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Socios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Dar de alta socio', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cargar socios', ['load'], ['class' => 'btn btn-primary']) ?>
        <?= ''/*Html::a('Cargar socios de tienda - Prestashop', ['loadfromps'], ['class' => 'btn btn-primary'])*/ ?>
        <?= Html::a('Cargar socios de tienda - WordPress', ['loadfromwp'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Exportar a Excel', ['export'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Exportar a Excel - sólo con DNI', ['/member/export/O'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Exportar a Excel - sólo con e-mail', ['/member/export/M'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Exportar a Excel - con e-mail y sin consent', ['/member/export/MN'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'surname',
            'badgeName',
            'badgeSurname',
             'email:email',
             'nif',
            // 'phone',
            // 'createdAt',
            // 'updatedAt',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
