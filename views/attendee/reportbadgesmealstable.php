<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe - ' . $subtitle;
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$rowsperpage = 52;

?>
<style type="text/css" media="print">
	@media print{
		@page {size: landscape}
	}
</style>
<div class="attendee-reportbadges">
	<?php for ($i = 0, $ct = count ($attendees); $i < $ct; $i++) { ?>
	<?php if ( ($i % $rowsperpage) == 0) { ?>
	<?php if ($i > 0) { ?>
	</tbody>
	</table>
</div>
<p class="pagebreak"> </p>
<div class="attendee-reportbadges">
	<?php }  ?>
	<table class="attendee-reportbadgesdet" cellpadding="1" cellspacing="1">
		<thead>
		<tr>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>Nombre acreditación</th>
			<th>Tipo pase</th>
			<th style="background-color: orange;">Cena cocktail</th>
			<th style="background-color: white; color: darkred;">Cena de gala</th>
			<th style="background-color: palegreen; color: darkgreen;">Comida sábado</th>
			<th style="background-color: palegreen;">Comida domingo</th>
			<th style="background-color: #B8FBB8; color: red;">Cena de los Valientes</th>
			<th>Observaciones - general</th>
			<th>Observaciones - cena de gala</th>
		</tr>
		</thead>
		<tbody>
		<?php } ?>
		<tr class="<?php if ($attendees[$i]->status == '0') echo 'notconfirmed'; else echo ($i % 2)? 'even': 'odd' ?>">
			<td><?= $attendees[$i]->name ?></td>
			<td><?= $attendees[$i]->surname ?></td>
			<td><?= $attendees[$i]->badgeName ?> <?= $attendees[$i]->badgeSurname ?></td>
			<td class="badge<?= $attendees[$i]->ticketType ?>"><?= $attendees[$i]->getTicketTypeValue() ?></td>
			<td class="c"><?php if ($attendees[$i]->mealFridayDinner) { ?> <span style="background-color: orange;">X</span><?php } ?></td>
			<td class="c"><?php if ($attendees[$i]->mealSaturdayDinner) { ?> <span style="background-color: white; color: darkred;">X</span><?php } ?></td>
			<td class="c"><?php if ($attendees[$i]->mealSaturdayLunch) { ?> <span style="background-color: palegreen; color: darkgreen;">X</span><?php } ?></td>
			<td class="c"><?php if ($attendees[$i]->mealSundayLunch) { ?> <span style="background-color: palegreen;">X</span><?php } ?></td>
			<td class="c"><?php if ($attendees[$i]->mealSundayDinner) { ?> <span style="background-color: #B8FBB8; color: red;">X</span><?php } ?></td>
			<td><?= $attendees[$i]->remarksMeals ?></td>
			<td><?= $attendees[$i]->remarksMealSaturday ?></td>
		</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
