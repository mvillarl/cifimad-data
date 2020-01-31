<?php

use app\models\Attendee;
use app\components\DateFunctions;

/* @var $this yii\web\View */
/* @var $attendeerooms [] */
/* @var $guests app\models\Guest[] */
/* @var $roomdays */

$this->title = 'Informe - Hotel';
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
	<div class="reportheadertxt">Habitaciones actores</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>DNI / Pasaporte</th>
			<th>Habitación</th>
			<?php for ($date = $guestsmindate; $date < $guestsmaxdate; $date = DateFunctions::dateAdd ($date ,1)) { ?>
			<th>Noche <?= DateFunctions::dateText ($date) ?></th>
			<?php } ?>
			<th>Observaciones</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($guests as $guest) { ?>
			<?php $companions = $guest->getCompanions(); ?>
			<tr>
				<td><?= strlen ($guest->pseudonym)? $guest->pseudonym: $guest->name ?>
				<?php foreach ($companions as $companion) { if (!$companion->excludeLodging && !$companion->separateRoom) { ?><br/><?= $companion->name ?><?php } } ?>
				</td>
				<td><?= strlen ($guest->pseudonym)? '': $guest->surname ?>
					<?php foreach ($companions as $companion) { if (!$companion->excludeLodging && !$companion->separateRoom) { ?><br/><?= $companion->surname ?><?php } } ?>
				</td>
				<td><?= $guest->nif_passport ?>
					<?php foreach ($companions as $companion) { if (!$companion->excludeLodging && !$companion->separateRoom) { ?><br/><?= $companion->nif_passport ?><?php } } ?>
				</td>
				<td>Suite</td>
				<?php for ($date = $guestsmindate; $date < $guestsmaxdate; $date = DateFunctions::dateAdd ($date ,1)) { ?>
					<td class="c"><?php if ( ($date >= $guest->dateArrival) && ($date < $guest->dateDeparture) ) { ?>X<?php } ?></td>
				<?php } ?>
				<td><?= nl2br ($guest->remarks) ?>
					<?php foreach ($companions as $companion) { if (!$companion->excludeLodging && !$companion->separateRoom) { ?><br/><?= nl2br ($companion->remarks) ?><?php } } ?>
				</td>
			</tr>
		<?php } ?>
		<?php // Habitaciones para acompañantes con habitación separada ?>
		<?php foreach ($guests as $guest) { ?>
		<?php $companions = $guest->getCompanions(); ?>
		<?php foreach ($companions as $companion) { if (!$companion->excludeLodging && $companion->separateRoom) { ?>
		<tr>
		<td><?= $companion->name ?></td>
		<td><?= $companion->surname ?></td>
		<td><?= $companion->nif_passport ?></td>
		<td>Individual</td>
		<?php for ($date = $guestsmindate; $date < $guestsmaxdate; $date = DateFunctions::dateAdd ($date ,1)) { ?>
			<td class="c"><?php if ( ($date >= $guest->dateArrival) && ($date < $guest->dateDeparture) ) { ?>X<?php } ?></td>
		<?php } ?>
			<td><?= nl2br ($companion->remarks) ?></td>
			<?php } ?>
		</tr>
		<?php } ?>
		<?php } ?>
		</tbody>
	</table>

	<div class="reportheadertxt">Asistentes alojados</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>DNI</th>
			<th>Habitación</th>
			<th>Miércoles - jueves</th>
			<th>Jueves - viernes</th>
			<th>Viernes - sábado</th>
			<th>Sábado - domingo</th>
			<th>Domingo - lunes</th>
			<th>Observaciones</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($attendeerooms as $attendeeroom) { ?>
		<tr <?php if ($attendeeroom->status == '2') {echo 'class="cancelled"'; } else if ($attendeeroom->status == '4') {echo 'class="modified"'; }  else if ($attendeeroom->status == '0') {echo 'class="notconfirmed"'; } ?>>
			<td><?php $first = true; foreach ($attendeeroom->names as $name) { ?>
					<?php if ($first) $first = false; else echo '<br/>'; ?><?= $name ?>
			<?php } ?></td>
			<td><?php $first = true; foreach ($attendeeroom->surnames as $surname) { ?>
					<?php if ($first) $first = false; else echo '<br/>'; ?><?= $surname ?>
				<?php } ?></td>
			<td><?php $first = true; foreach ($attendeeroom->nifs as $nif) { ?>
					<?php if ($first) $first = false; else echo '<br/>'; ?><?= $nif ?>
				<?php } ?></td>
			<td><?= $attendeeroom->roomType ?></td>
			<td class="c"><?= $attendeeroom->wednesday? 'X': '' ?></td>
			<td class="c"><?= $attendeeroom->thursday? 'X': '' ?></td>
			<td class="c"><?= $attendeeroom->friday? 'X': '' ?></td>
			<td class="c"><?= $attendeeroom->saturday? 'X': '' ?></td>
			<td class="c"><?= $attendeeroom->sunday? 'X': '' ?></td>
			<td><?= nl2br ($attendeeroom->remarks) ?></td>
		<?php } ?>
		<tr>
			<td colspan="4"></td>
			<td class="c"><?= $roomdays->wednesday ?></td>
			<td class="c"><?= $roomdays->thursday ?></td>
			<td class="c"><?= $roomdays->friday ?></td>
			<td class="c"><?= $roomdays->saturday ?></td>
			<td class="c"><?= $roomdays->sunday ?></td>
		</tr>
		<tr>
			<td class="n" title="Total alojados">TA: <?= $totallodged ?></td>
			<td class="n" title="Total habitaciones">TH: <?= $totalrooms ?></td>
		</tr>
		</tbody>
	</table>

	<div class="reportheadertxt">Cena del viernes</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Número</th>
			<th>Alergias e intolerancias</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?= $mealsummary['fridayDN'] ?></td>
			<td><ul><?php foreach ($mealsummary['fridayRemarks'] as $remark => $number) { ?>
				<li><?= nl2br ($remark) ?><?= $number > 1? ': ' . $number: '' ?></li>
			<?php } ?></ul></td>
		</tr>
		</tbody>
		</table>


	<div class="reportheadertxt">Cena del sábado</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Número</th>
			<th>Alergias e intolerancias</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?= $mealsummary['saturdayDN'] ?></td>
			<td><ul><?php foreach ($mealsummary['saturdayRemarks'] as $remark => $number) { ?>
				<li><?= nl2br ($remark) ?><?= $number > 1? ': ' . $number: '' ?></li>
			<?php } ?></ul></td>
		</tr>
		</tbody>
		</table>

	<div class="reportheadertxt">Comidas buffet</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<th>Comida sábado</th>
		<th>Comida domingo</th>
		<th>Cena de los Valientes</th>
		</thead>
		<tbody>
		<tr>
			<td><?= $mealsummary['saturdayLN'] ?></td>
			<td><?= $mealsummary['sundayLN'] ?></td>
			<td><?= $mealsummary['sundayDN'] ?></td>
		</tr>
		</tbody>
	</table>
</div>
