<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VolunteerInscription */
/* @var $events array */
/* @var $computersLevels array */

$this->title = 'Modificar Inscripción de voluntario: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones de voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-inscription-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
        'computersLevels' => $computersLevels,
    ]) ?>

</div>
