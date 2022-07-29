<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Attendee */

$this->title = 'Modificar asistente: ' . $model->memberName;
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->memberName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="attendee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
        'sources' => $sources,
        'isPandemic' => $isPandemic,
        'hasVIPAttendees' => $hasVIPAttendees,
    ]) ?>

</div>
