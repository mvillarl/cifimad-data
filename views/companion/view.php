<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companion */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Acompañantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companion-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar este acompañante?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'idGuest',
            'name',
            'surname',
            'badgeName',
            'badgeSurname',
            'nif_passport',
            'remarks:ntext',
            'remarksMeals:ntext',
            'remarksMealsSaturday:ntext',
            'separateRoom:boolean',
            'excludeLodging:boolean',
            'excludeFridayDinner:boolean',
        ],
    ]) ?>

</div>
