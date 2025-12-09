<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $data [] */
/* @var $maxChildrenCifiKids integer */

$this->title = 'Informe - CifiKids';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php foreach ($data as $table) { ?>
<div class="attendee-reportcifikids">
    <div class="reportheader">
        <div class="logoleft"><img src="/img/Logo_CIFIMAD_2016_banner_360.png"/></div>
        <div class="logoright"><img src="/img/logo_cifikids.png"/></div>
    </div>
<div class="reportheadertxt"><?= $table['title'] ?></div>
    <p class="reportsubheadertxt">Autorizo a que mi hijo participe en las actividades organizadas en Cifikids en el horario arriba establecido, <br/>
        comprometiéndome a recogerle a la hora de finalización en la puerta del recinto.</p>
<table class="reporthoteltable" cellpadding="2" cellspacing="2">
	<thead>
	<tr>
        <th></th>
		<th>Nombre niño</th>
		<th>Apellidos niño</th>
		<th>Nombre y apellidos adulto</th>
		<th>Teléfono adulto</th>
		<th>Firma padre/madre/tutor</th>
	</tr>
	</thead>
	<tbody>
	<?php for ($i = 0, $st = count ($table['children']); $i < $maxChildrenCifiKids; $i++) { $child = ($i < $st)? $table['children'][$i]: null; ?>
		<tr>
            <td><?= $i + 1 ?></td>
			<td><?= is_object($child)? $child->badgeName: '' ?></td>
			<td><?= is_object($child)? $child->badgeSurname: '' ?></td>
			<td><?= is_object($child)? $child->parentName: '' ?></td>
			<td><?= is_object($child)? (strlen ($child->parentPhone)? $child->parentPhone: '-- Falta teléfono --'): '' ?></td>
            <td class="firma"></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>

