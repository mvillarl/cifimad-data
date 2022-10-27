<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Poll */

$this->title = 'Modificar encuesta: ' . $model->pkey;
$this->params['breadcrumbs'][] = ['label' => 'Polls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pkey, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="poll-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
