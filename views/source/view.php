<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Source */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (strlen ($model->imageFile)) { ?>
        Logo: <img src="/img/logos/<?= $model->imageFile ?>"/>
    <?php } ?>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar esta procedencia?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'separateList:boolean',
            'blankBadges',
        ],
    ]) ?>

</div>
