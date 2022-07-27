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
		'mealSundayDinner:boolean',
		[
			'attribute' => 'cifiKidsDays',
			'value' => $model->getCifiKidsDayValue(),
		],
        ];
	foreach ($model->getGuestFields() as $field) $attributes[] = $field;
	foreach ($model->getExtraProductFields() as $field) $attributes[] = $field;
	$attributes = array_merge ($attributes, [
		'remarksRegistration:ntext',
        'remarksOrPendingPaymentDone:boolean',
		'orders',
		'parkingReservation',
	]);
	if ($isPandemic) {
		$attributes[] = 'phoneAtDesk';
	}
	?>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => $attributes,
	]) ?>

</div>
