<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VolunteerInscription */
/* @var $events array */

$this->title = 'Crear Inscripción de voluntario';
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones de voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-inscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
    ]) ?>

</div>
