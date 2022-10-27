<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PollAnswer */
/* @var $polls app\models\Poll[] */

$this->title = 'Modificar respuesta de encuesta: ' . $model->answerText;
$this->params['breadcrumbs'][] = ['label' => 'Encuestas - respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="poll-answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'polls' => $polls,
    ]) ?>

</div>
