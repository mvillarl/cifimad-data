<?php
$this->title = 'Informe - cuentas';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$incomestexts = array (
	'doubleFSDinners' => 'Hab doble VS + cenas',
	'singleFSDinners' => 'Hab individual VS + cenas',
	'tripleFSDinners' => 'Hab triple VS + cenas',
	'doubleSDinners' => 'Hab doble S + cena',
	'singleSDinners' => 'Hab individual S + cena',
	'tripleSDinners' => 'Hab triple S + cena',
	'doubleExtraDays' => 'Días extra hab doble',
	'singleExtraDays' => 'Días extra hab individual',
	'tripleExtraDays' => 'Días extra hab triple',
	'fridayDinners' => 'Cenas cóctel',
	'saturdayLunches' => 'Comidas sábado',
	'saturdayDinners' => 'Cenas gala',
	'sundayLunches' => 'Comidas domingo',
	'sundayDinners' => 'Cenas domingo',
	'dayPasses' => 'Entradas viernes / domingo',
	'saturdayPasses' => 'Entradas sábado',
	'weekendPasses' => 'Entradas fin de semana',
);
$gi = 1;
foreach ($guests as $guest) {
	if ($guest->hasPhotoshoot) $incomestexts['photo'.$gi] = 'Fotos '.$guest->name;
	if ($guest->hasPhotoshootSpecial) $incomestexts['photoSpecial'.$gi] = 'Fotos especiales '.$guest->name;
	if ($guest->hasAutograph) $incomestexts['signature'.$gi] = 'Firmas '.$guest->name;
	if ($guest->hasAutographSpecial) $incomestexts['signatureSpecial'.$gi] = 'Firmas especiales '.$guest->name;
	if ($guest->hasVintage) $incomestexts['vintage'.$gi] = 'Cartones '.$guest->name;
	$gi++;
}
?>
<div class="attendee-reportincomes">
	<div class="reportheader">
		<div class="logoleft"><img src="/img/Logo_CIFIMAD_2016_banner_360.png"/></div>
	</div>
</div>
<div class="reportheadertxt">Cuentas</div>
	<table class="reporthoteltable" cellpadding="2" cellspacing="2">
		<thead>
		<tr>
			<th>Inscripciones</th>
			<th>Cantidad</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($incomes as $name => $value) { ?>
			<tr>
				<td><?= $incomestexts[$name] ?></td>
				<td class="n"><?= $value ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>

</div>