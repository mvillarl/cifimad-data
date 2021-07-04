<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VolunteerInscription */
/* @var $events array */

$this->title = 'Update Volunteer Inscription: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Volunteer Inscriptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volunteer-inscription-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'events' => $events,
    ]) ?>

</div>
