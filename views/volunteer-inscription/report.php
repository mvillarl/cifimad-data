<?php
use app\models\VolunteerInscription;

/* @var $this yii\web\View */
/* @var $inscriptions app\models\VolunteerInscription[] */
/* @var $functions array */
/* @var $shifts array */

$this->title = 'Informe - Inscripciones de voluntarios';
$this->params['breadcrumbs'][] = ['label' => 'Inscripciones de voluntarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$rowsperpage = 40;
?>
<div class="volunteers">
	<table class="volunteers" cellpadding="1" cellspacing="1">
		<thead>
		<tr class="volunteertitle">
			<th colspan="<?= 4 + count ($functions) ?>">Voluntarios por dónde colaboran</th>
		</tr>
		<tr>
			<th>Nombre y apellidos</th>
			<th>Email</th>
			<th>Nombre Facebook</th>
			<?php foreach ($functions as $code => $name) { ?>
                <th><a href="#" class="showrows" data-row="<?= $code ?>"><?= $name ?></a> <span class="showrowsind">v</span></th>
			<?php } ?>
            <th>Otra</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($inscriptions as $inscription) { ?>
			<tr class="rowshow <?php foreach ($functions as $code => $name) { if ($inscription->hasFunction ($code) ) { ?><?= $code ?> <?php } } ?>">
				<td><?= $inscription->name ?></td>
				<td><?= $inscription->email ?></td>
				<td><?= $inscription->nameFacebook ?></td>
				<?php foreach ($functions as $code => $name) { ?>
                    <td class="mark"><?php if ($inscription->hasFunction ($code) ) { ?> X <?php } ?></td>
				<?php } ?>
                <td><?= $inscription->functionOther ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
    <br/><br/>
	<table class="volunteers" cellpadding="1" cellspacing="1">
		<thead>
		<tr class="volunteertitle">
			<th colspan="<?= 4 + count ($shifts) ?>">Voluntarios por disponibilidad</th>
		</tr>
		<tr>
			<th>Nombre y apellidos</th>
			<th>Email</th>
			<th>Nombre Facebook</th>
			<?php foreach ($shifts as $code => $name) { ?>
                <th><a href="#" class="showrows" data-row="<?= $code ?>" title="<?= $name ?>"><?= \app\models\VolunteerInscriptionShift::shortShiftName ($name) ?></a> <span class="showrowsind">v</span></th>
			<?php } ?>
            <th>Otra</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($inscriptions as $inscription) { ?>
			<tr class="rowshow <?php foreach ($shifts as $code => $name) { if ($inscription->hasShift ($code) ) { ?><?= $code ?> <?php } } ?>">
				<td><?= $inscription->name ?></td>
				<td><?= $inscription->email ?></td>
				<td><?= $inscription->nameFacebook ?></td>
				<?php foreach ($shifts as $code => $name) { ?>
                    <td class="mark"><?php if ($inscription->hasShift ($code) ) { ?> X <?php } ?></td>
				<?php } ?>
                <td><?= $inscription->functionOther ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>