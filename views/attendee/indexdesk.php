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
		'label' => 'Observaciones',
		'attribute' => 'remarksRegistration',
		'format'=>'raw',
		'content' => 'app\components\AttendeeColumns::remarksCol',
	];
	$attendeeColumns[] = [
		'attribute' => 'orders',
		//'label' => 'Nº pedido/s',
		//'headerOptions' => ['title' => $extraProductsTitle],
		//'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
		'format'=>'raw',
		//'content' => 'app\components\AttendeeColumns::orderNumbersCol',
	];
	if ($isPandemic) {
		$attendeeColumns[] = [
			'attribute' => 'memberPhone',
			'label'     => ' ',
			'format'    => 'raw',
			'value'     => function ( $model, $key, $index ) {
				if ( empty ( $model->memberPhone ) && empty ( $model->phoneAtDesk ) ) {
					$ret = 'No tiene teléfono - pedir y guardar';
				} else {
					$ret = '';
				}

				return $ret;
			}
		];
	}
    $attendeeColumns[] = [
        'attribute'=>'remarksOrPendingPaymentDone',
        'label' => 'Marcar',
        'format'=>'raw',
        'value' => function($model, $key, $index) {
            $ret = '<input type="checkbox" class="checkboxinline" name="remarksOrPendingPaymentDone_' . $model->id . '" data-id="' . $model->id . '" ';
            if ($model->remarksOrPendingPaymentDone) {
                $ret .= ' checked="true"';
            }
            $ret .= '/>';
            return $ret;
        }
    ];
	$actionColumnRow = ['class' => 'yii\grid\ActionColumn', 'visibleButtons' => ['delete' => false] ];
	if ($isPandemic) {
		$actionColumnRow['visibleButtons']['update'] = function($model, $key, $index) {
			return  (empty ($model->memberPhone) && empty ($model->phoneAtDesk));
		};
    } else {
		$actionColumnRow['visibleButtons']['update'] = false;
    }
    $attendeeColumns[] = $actionColumnRow;

	?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => $attendeeColumns,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return app\components\AttendeeColumns::rowOptions ($model, $key, $index, $grid, true);
        },
	]); ?>
</div>
<?php
$this->registerJsFile('/js/checkboxesListDesk.js?v1', ['depends' => [\yii\jui\JuiAsset::className()]]);
?>