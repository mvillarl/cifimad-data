<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cargar socios';
$this->params['breadcrumbs'][] = ['label' => 'Socios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="member-load">

	<?php if ($error) { ?>
	<div class="alert alert-danger text-center">
		<?php foreach ($error as $field => $errorin ) { ?>
			<?= $model->getAttributeLabel($field) ?>:
				<?php foreach( $errorin as $msg) { ?>
					<?= $msg ?>,
				<?php } ?>
			<br/>
		<?php } ?>
	</div>
	<?php } ?>
	<p>Introduce un socio en cada línea, con cada campo separado por tabuladores</p>
	<p>El orden de las columnas debe ser: Nombre - Apellidos - E-mail - DNI - Teléfono - Vacuna</p>
    <p>Los valores para Vacuna deben ser: P (parcial), C (completa), N (no tiene), R (prefiere no decirlo)</p>
	<p>Se puede copiar y pegar directamente de un Excel</p>
	<?php $form = ActiveForm::begin(); ?>

	<?= Html::textArea('memberdata', '', ['rows' => '10', 'cols' => '90']) ?>

	<p>Si lo deseas, en el mismo paso puedes añadir estos socios como asistentes al evento.
	Para ello, rellena los siguientes campos:</p>

	<?= HTML::dropDownList('idEvent', null, $events); ?>
	<?= HTML::dropDownList('idSource', null, $sources); ?>
	<?= HTML::dropDownList('idTicketType', null, $tickettypes); ?>
	<p><br/></p>

	<div class="form-group">
		<?= Html::submitButton('Cargar', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
