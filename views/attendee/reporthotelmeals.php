<?php

use app\models\Attendee;
use app\components\DateFunctions;

/* @var $this yii\web\View */
/* @var $attendeerooms [] */
/* @var $guests app\models\Guest[] */

$this->title = 'Informe - Hotel - comidas y cenas';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--
<style type="text/css" media="print">
                             @media print{
	@page {size: landscape}
	}
</style>
-->
<div class="attendee-reporthotel">
	<div class="reportheader">
		<div class="logoleft"><img src="/img/Logo_CIFIMAD_2016_banner_360.png"/></div>
		<div class="logoright"><img src="/img/HLP_360.png"/></div>
	</div>

	<div class="reportheadertxt">Cena del viernes</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Número</th>
			<th>Nombre</th>
			<th>Nombre acr</th>
			<th>Observaciones</th>
		</tr>
		</thead>
		<tbody>
		<?php for ($i = 0, $ct = count ($fridayDinner); $i < $ct; $i++) { ?>
			<tr <?php if ($fridayDinner[$i]->status == '0') {echo 'class="notconfirmed"'; } ?>>
				<td><?= ($i + 1) ?></td>
				<td><?= $fridayDinner[$i]->attendeeName ?></td>
				<td><?= $fridayDinner[$i]->memberName ?></td>
				<td><?= $fridayDinner[$i]->remarksMeals ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<th>Total: <?= $ct ?></th>
		</tr>
		</tfoot>
	</table>


	<div class="reportheadertxt">Cena del sábado</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Número</th>
			<th>Nombre</th>
			<th>Nombre acr</th>
			<th>Observaciones</th>
		</tr>
		</thead>
		<tbody>
		<?php for ($i = 0, $ct = count ($saturdayDinner); $i < $ct; $i++) { ?>
			<tr <?php if ($saturdayDinner[$i]->status == '0') {echo 'class="notconfirmed"'; } ?>>
				<td><?= ($i + 1) ?></td>
				<td><?= $saturdayDinner[$i]->attendeeName ?></td>
				<td><?= $saturdayDinner[$i]->memberName ?></td>
				<td><?= $saturdayDinner[$i]->remarksMeals ?>
				<?php if (strlen ($saturdayDinner[$i]->remarksMeals) && strlen ($saturdayDinner[$i]->remarksMealSaturday) ) { ?>
						<br/>
				<?php } ?>
					<?= $saturdayDinner[$i]->remarksMealSaturday ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<th>Total: <?= $ct ?></th>
		</tr>
		</tfoot>
	</table>

	<div class="reportheadertxt">Comidas buffet - sábado</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<th>Número</th>
		<th>Nombre</th>
		<th>Nombre acr</th>
		</thead>
		<tbody>
		<?php for ($i = 0, $ct = count ($saturdayLunch); $i < $ct; $i++) { ?>
			<tr <?php if ($saturdayLunch[$i]->status == '0') {echo 'class="notconfirmed"'; } ?>>
				<td><?= ($i + 1) ?></td>
				<td><?= $saturdayLunch[$i]->attendeeName ?></td>
				<td><?= $saturdayLunch[$i]->memberName  ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<th>Total: <?= $ct ?></th>
		</tr>
		</tfoot>
	</table>

	<div class="reportheadertxt">Comidas buffet - domingo</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<th>Número</th>
		<th>Nombre</th>
		<th>Nombre acr</th>
		</thead>
		<tbody>
		<?php for ($i = 0, $ct = count ($sundayLunch); $i < $ct; $i++) { ?>
			<tr <?php if ($sundayLunch[$i]->status == '0') {echo 'class="notconfirmed"'; } ?>>
				<td><?= ($i + 1) ?></td>
				<td><?= $sundayLunch[$i]->attendeeName ?></td>
				<td><?= $sundayLunch[$i]->memberName  ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<th>Total: <?= $ct ?></th>
		</tr>
		</tfoot>
	</table>

	<div class="reportheadertxt">Comidas buffet - Cena de los Valientes</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<th>Número</th>
		<th>Nombre</th>
		<th>Nombre acr</th>
		</thead>
		<tbody>
		<?php for ($i = 0, $ct = count ($sundayDinner); $i < $ct; $i++) { ?>
			<tr <?php if ($sundayDinner[$i]->status == '0') {echo 'class="notconfirmed"'; } ?>>
				<td><?= ($i + 1) ?></td>
				<td><?= $sundayDinner[$i]->attendeeName ?></td>
				<td><?= $sundayDinner[$i]->memberName  ?></td>
			</tr>
		<?php } ?>
		</tbody>
		<tfoot>
		<tr>
			<th>Total: <?= $ct ?></th>
		</tr>
		</tfoot>
	</table>
</div>
