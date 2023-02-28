<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VolunteerInscription */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones de voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volunteer-inscription-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar esta inscripción?',
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
            'email:email',
            'phone',
            'nameFacebook',
	        'computersLevelValue',
	        'activitiesRequired',
	        'activitiesDesired',
	        [
		        'attribute' => 'volunteerInscriptionFunctions',
		        'value' => $model->getFunctionsValue(),
	        ],
	        [
		        'attribute' => 'volunteerInscriptionShifts',
		        'value' => $model->getShiftsValue(),
	        ],
	        'otherVolunteer'
        ],
    ]) ?>

</div>
