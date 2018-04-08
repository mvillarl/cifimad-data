<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Guest */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Invitados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar el invitado?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'eventName',
            'name',
            'surname',
            'characterName',
            'order',
            'nif_passport',
            'remarks',
            'remarksMeals',
            'dateArrival:date',
            'dateDeparture:date',
            'hasAutograph:boolean',
            'hasAutographSpecial:boolean',
            'hasPhotoshoot:boolean',
            'hasPhotoshootSpecial:boolean',
            'hasVintage:boolean',
        ],
    ]) ?>

</div>
