<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Poll */

$this->title = $model->pkey;
$this->params['breadcrumbs'][] = ['label' => 'Encuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->pkey;
\yii\web\YiiAsset::register($this);
?>
<div class="poll-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar esta encuesta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pkey',
            'title',
        ],
    ]) ?>

</div>
