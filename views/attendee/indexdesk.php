<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AttendeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistentes';
$this->params['breadcrumbs'][] = $this->title;

$fields = $searchModel->getGuestFields();
$pfields = $searchModel->getExtraProductFields();
$photosAutosTitle = '';
for ($i = 0, $ct = count ($fields); $i < $ct; $i++) {
	if ($i > 0) $photosAutosTitle .= ' - ';
	$photosAutosTitle .= $searchModel->getAttributeLabel ($fields[$i]);
}
$extraProductsTitle = '';
for ($i = 0, $ct = count ($pfields); $i < $ct; $i++) {
	if ($i > 0) $extraProductsTitle .= ' - ';
	$extraProductsTitle .= $searchModel->getAttributeLabel ($pfields[$i]);
}
?>
<div class="attendee-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p class="error-summary">
		<?php foreach ($errors as $error) { ?>
			<span class="error"><?= $error ?></span><br/>
		<?php } ?>
	</p>

	<?php
	$yesno = ['0' => 'No', '1' => 'Sí'];
	$attendeeColumns = [
		['class' => 'yii\grid\SerialColumn'],

		//'id',
		[
			'attribute'=>'idEvent',
			'format'=>'raw',
		],
		[
			'attribute'=>'memberName',
			'format'=>'raw',
		],
		[
			'label' => 'Nombre',
			'attribute'=>'attendeeName',
			'format'=>'raw',
		],
		[
			'attribute'=>'status',
			'format'=>'raw',
			'value' => function($model, $key, $index) {
				return $model->getStatusValue();
			}
		],
		[
			'attribute'=>'ticketType',
			'format'=>'raw',
			'value' => function($model, $key, $index) {
				return $model->getTicketTypeValue();
			}
		],
		[
			'attribute'=>'idSource',
			'format'=>'raw',
			'value' => function($model, $key, $index) {
				return $model->sourceName;
			}
		],
		[
			'label' => 'Comidas',
			'headerOptions' => ['title' => 'Cena Cocktail - Comida sábado - Cena de Gala - Comida domingo - Cena de los Valientes'],
			'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
			'format'=>'raw',
			'content' => 'app\components\AttendeeColumns::mealsCol',
		],
		[
			'label' => 'Fotos y firmas',
			'headerOptions' => ['title' => $photosAutosTitle],
			'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
			'format'=>'raw',
			'content' => 'app\components\AttendeeColumns::photosCol',
		],
	];
	if (strlen ($extraProductsTitle)) $attendeeColumns[] = [
		'label' => 'Extra',
		'headerOptions' => ['title' => $extraProductsTitle],
		'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
		'format'=>'raw',
		'content' => 'app\components\AttendeeColumns::productsCol',
	];
	$attendeeColumns[] = [
		'label' => 'Nº pedido/s',
		//'headerOptions' => ['title' => $extraProductsTitle],
		//'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
		'format'=>'raw',
		'content' => 'app\components\AttendeeColumns::orderNumbersCol',
	];
	$attendeeColumns[] = ['class' => 'yii\grid\ActionColumn', 'visibleButtons' => ['update' => false, 'delete' => false] ];

	?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $attendeeColumns,
	]); ?>
</div>
