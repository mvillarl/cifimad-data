<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CosplayInscription */
/* @var $events array */
/* @var $categories array */

$this->title = 'Crear Inscripción al concurso de cosplay';
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones a concurso de cosplay', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cosplay-inscription-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
        'categories' => $categories,
        'soundtrackvalues' => $soundtrackvalues,
    ]) ?>

</div>
