<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CosplayInscription */

$this->title = $model->fullname . ' - ' . $model->characterName;
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones a concurso de cosplay', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cosplay-inscription-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que lo quieres borrar?',
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
            'email:email',
            [
                'attribute' => 'category',
                'value' => $model->getCategoryValue(),
            ],
            'characterName',
            'remarks:ntext',
            'hasPerformance:boolean',
            'hasSoundtrack:boolean',
            'status:boolean',
        ],
    ]) ?>

</div>
