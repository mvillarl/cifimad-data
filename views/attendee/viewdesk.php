<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\components\AttendeeColumns;

/* @var $this yii\web\View */
/* @var $model app\models\Attendee */

$this->title = $model->memberName;
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendee-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Borrar', ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => '¿Seguro que quieres borrar este asistente?',
				'method' => 'post',
			],
		]) ?>
	</p>

	<?php
	$attributes = [
		'id',
		'eventName',
		[
			'attribute' => 'memberName',
			'value'=> $model->memberName . ' / ' . $model->attendeeName,
		],
		[
			'attribute' => 'status',
			'value' => $model->getStatusValue(),
		],
		[
			'attribute' => 'ticketType',
			'value' => $model->getTicketTypeValue(),
		],
		'sourceName',
		'mealFridayDinner:boolean',
		'mealSaturdayLunch:boolean',
		'mealSaturdayDinner:boolean',
		'mealSundayLunch:boolean',
		'mealSundayDinner:boolean'];
	foreach ($model->getGuestFields() as $field) $attributes[] = $field;
	foreach ($model->getExtraProductFields() as $field) $attributes[] = $field;
	$attributes = array_merge ($attributes, [
		'remarksRegistration:ntext',
	]);
	?>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => $attributes,
	]) ?>

</div>
