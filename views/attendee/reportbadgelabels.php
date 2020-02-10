<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe - etiquetas para acreditaciones';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attendee-reportbadgelabels">
	<div id="warnings"></div>
	<table class="attendee-reportbadgelabels" cellpadding="0" cellspacing="0">
		<?php $type = ''; $long = 0; $isEspecial = false; $isCompanion = false; foreach ($attendees as $attendee) { ?>
			<?php
			$longd = 1.5;
			if ($attendee->isSpecial || $attendee->idSource == '2') $longd += 1.5;
			if (!$isEspecial && ($attendee->isSpecial || $attendee->idSource == '2') ) $longd += 1.5;
			if ($isEspecial && !$attendee->isSpecial && ($attendee->idSource != '2') && ($attendee->ticketType != $type) ) $longd += 1.5;
			if (strlen (trim ($attendee->parentName) ) ) $longd += 4.5;
		if (false && ($long + $longd > 26) ) {
				$long = $longd; ?>
				</table>
	</div>
	<p class="pagebreak">&nbsp;</p>
<div class="attendee-reportbadgelabels">
	<table class="attendee-reportbadgelabels" cellpadding="0" cellspacing="0">
			<?php } else { $long += $longd; } ?>				
			<?php if (!$isCompanion && ($attendee->idSource == 'C') ) { ?>
				<?php $isCompanion = true; $long += 1.5; ?>
				<tr>
					<td colspan="2" class="title">Acompañantes</td>
				</tr>
			<?php } ?>
			<?php if (!$isEspecial && ($attendee->isSpecial || $attendee->idSource == '2') ) { ?>
				<?php $isEspecial = true; $long += 1.5; ?>
				<tr>
					<td colspan="2" class="title">Staff y Cochrane</td>
				</tr>
			<?php } ?>
		<?php if ($isEspecial && !$attendee->isSpecial && ($attendee->idSource != '2') && ($attendee->ticketType != $type) ) { ?>
				<?php $type = $attendee->ticketType; ?>
			<tr>
				<td colspan="2" class="title tit<?= $type ?>"><?= $attendee->getTicketTypeValue() ?></td>
			</tr>
			<?php } ?>
			<tr>
				<td class="badgelabelhint<?= strlen ($type)? $type: 'F' ?>"> </td>
				<td class="badgelabel<?php if ($attendee->isSpecial) { ?> special<?php } ?><?php if ($attendee->idSource == 'C') { ?> companion<?php } ?><?php if ($attendee->memberSmall == 1 || bin2hex ($attendee->memberSmall) == '01') { ?> small<?php } ?>">
                <span class="badgelabelin">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimage"/><?php }?>
					<?= $attendee->memberName ?></span>
				</td>
				<td class="badgetype">
					<?php if ($showinfotickets) { ?>
						<?php if ($attendee->mealFridayDinner) { ?>Cena Cocktail<br/><?php } ?>
						<?php if ($attendee->mealSaturdayDinner) { ?>Cena Gala<br/><?php } ?>
						<?php if ($attendee->mealSundayDinner) { ?>Cena Valientes<br/><?php } ?>
						<?php if ($attendee->mealSaturdayLunch) { ?>Comida sábado<br/><?php } ?>
						<?php if ($attendee->mealSundayLunch) { ?>Comida domingo<br/><?php } ?>
						<?php
						$attendee->setEvent($idEvent, $guests,$extraproducts);
						$fields = $attendee->getGuestFields();
						foreach ($fields as $field) {?>
							<?php if ($attendee->{$field}) { ?><?= $attendee->getAttributeLabel($field) ?><br/><?php } ?>
						<?php } ?>
					<?php } ?>
				</td>
			</tr>
			<?php if ( ($attendee->isSpecial || ($attendee->idSource == '2') || ($attendee->idSource == 'C') ) && !strlen (trim ($attendee->parentName) ) ) { ?>
				<tr>
					<td class="badgelabelhintF"> </td>
					<td class="badgelabel<?php if ($attendee->isSpecial) { ?> special<?php } ?><?php if ($attendee->idSource == 'C') { ?> companion<?php } ?><?php if ($attendee->memberSmall == 1 || bin2hex ($attendee->memberSmall) == '01') { ?> small<?php } ?>">
                    <span class="badgelabelin">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimage"/><?php }?>
                    <?= $attendee->memberName ?></span></td>
				</tr>
			<?php } ?>
			<?php if (strlen (trim ($attendee->parentName) ) ) { ?>
				<tr>
					<td></td>
					<td class="parent"><?= $attendee->parentName ?><br/><br/>
					<?= strlen ($attendee->parentPhone)? $attendee->parentPhone: '-- Falta telefono --' ?></td>
				</tr>
			<?php } ?>
		<?php } ?>
		<?php if (false) { ?>
		<tr>
			<td class="badgelabelhintF"> </td>
			<td class="badgelabel"><span class="badgelabelin">
					<img src="/img/logos/R2.png" class="sourceimage"/>
					R2-D2</td>
			<td class="badgetype"></td>
		</tr>
		<tr>
			<td class="badgelabelhintF"> </td>
			<td class="badgelabel"><span class="badgelabelin">
					<img src="/img/logos/R2.png" class="sourceimage"/>
					R2-D2</td>
			<td class="badgetype"></td>
		</tr>
		<tr>
			<td class="badgelabelhintF"> </td>
			<td class="badgelabel"><span class="badgelabelin">
					<img src="/img/logos/R2.png" class="sourceimage"/>
					C1-10P "Chopper"</td>
			<td class="badgetype"></td>
		</tr>
		<?php } ?>
		<?php if (!$afterprint) { ?>
			<?php for ($i = 0; $i < 15; $i++) { ?>
			<tr>
			<td class="badgelabelhintD"> </td>
			<td class="badgelabel"><span class="badgelabelin">ACADI  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td class="badgetype"></td>
		</tr>
			<?php } ?>
			<?php foreach ($blankBadges as $source) { ?>
				<?php for ($i = 0; $i < $source->blankBadges; $i++) { ?>
				<tr>
					<td class="badgelabelhintF"> </td>
					<td class="badgelabel">
						<span class="badgelabelin">
						<?php if (strlen ($source->imageFile) ) { ?><img src="/img/logos/<?= $source->imageFile ?>" class="sourceimage"/><?php }?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="badgetype"></td>
				</tr>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	</table>
</div>
<script src="/assets/a9a1902f/jquery.js"></script>
<script type="text/javascript" src="/js/reportcheckdimensions.js?v1.1"></script>
