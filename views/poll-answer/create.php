<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PollAnswer */
/* @var $polls app\models\Poll[] */

$this->title = 'Crear respuesta de encuesta';
$this->params['breadcrumbs'][] = ['label' => 'Encuestas - respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'polls' => $polls,
    ]) ?>

</div>
