<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CosplayInscription */

$this->title = 'Modificar Inscripción a concurso de cosplay: ' . $model->fullname . ' - ' . $model->characterName;
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones a concurso de cosplay', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$model->fullname . ' - ' . $model->characterName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cosplay-inscription-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
    ]) ?>

</div>
