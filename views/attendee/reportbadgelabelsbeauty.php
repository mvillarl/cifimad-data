<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */
/* @var $blankBadges app\models\Source[] */
/* @var $badgesCifiKids app\models\Attendee[] */
/* @var $verticalBadges boolean */
/* @var $acadiBadges integer */

$this->title = 'Informe - acreditaciones completas';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$classcontmap = [
        'F' => 'weekendcont',
        'V' => 'fridaycont',
        'S' => 'saturdaycont',
        'D' => 'sundaycont',
]
?>
<div class="attendee-reportbadgelabels beauty">
	<div id="warnings"></div>
<?php $type = ''; $long = 0; $isEspecial = false; $isVolunteer = false; $isCompanion = false; $cifikidsShown = false; foreach ($attendees as $attendee) { ?>
	<?php
	$longd = 1.5;
	if ($attendee->idSource != 'C') {
		if ( $attendee->isSpecial || $attendee->getSourceIsVolunteer() ) {
			$longd += 1.5;
		}
		if ( ! $isEspecial && ( $attendee->isSpecial || $attendee->getSourceIsVolunteer() ) ) {
			$longd += 1.5;
		}
		if ( $isEspecial && ! $attendee->isSpecial && ( ! $attendee->getSourceIsVolunteer() ) && ( $attendee->ticketType != $type ) ) {
			$longd += 1.5;
		}
		if ( strlen( trim( $attendee->parentName ) ) ) {
			$longd += 4.5;
		}
	}
?>
	<?php if (!$isCompanion && ($attendee->idSource == 'C') ) { ?>
		<?php $isCompanion = true; $long += 1.5; ?>
		<p class="btitle">Acompañantes</p>
	<?php } ?>
    <?php //if ($attendee->memberName == 'Amanda Gomez L') {
        //echo "<li>$isEspecial-$isVolunteer-".$attendee->isSpecial.'-'.$attendee->sourceIsVolunteer; ?>
	<?php //} ?>
	<?php if (!$isEspecial && !$isVolunteer && $attendee->isSpecial && ($attendee->getSourceIsVolunteer() ) ) { ?>
		<?php $isEspecial = true; $isVolunteer = true; $long += 1.5; ?>
		<p class="btitle">Staff del Cochrane - Acred doble roja</p>
	<?php } ?>
	<?php if ($isEspecial && $isVolunteer && $attendee->isSpecial && ($attendee->idSource == '4') ) { ?>
		<?php $isEspecial = true; $isVolunteer = false; $long += 1.5; ?>
		<p class="btitle">Miembros del Cochrane - Acred doble normal</p>
	<?php } ?>
	<?php if ($isEspecial && !$isVolunteer && !$attendee->isSpecial && ($attendee->getSourceIsVolunteer() ) ) { ?>
		<?php $isEspecial = false; $isVolunteer = true; $long += 1.5; ?>
		<p class="btitle">Staff de otros clubes - Acred doble amarilla</p>
	<?php } ?>
	<?php if ( ($isEspecial || $isVolunteer) && !$attendee->isSpecial && (!$attendee->getSourceIsVolunteer() ) ) { ?>
        <?php $isEspecial = false; $isVolunteer = false; ?>
        <?php if ($attendee->ticketType != $type) { ?>
            <?php if (!$cifikidsShown) { ?>
                <?php if (!empty ($badgesCifiKids)) { ?>
                    <p class="btitle">CifiKids - acreditación azul especial</p>
                    <p>Aquí va el bucle de CifiKids - revisar</p>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <?php if (!$isEspecial && !$isVolunteer && ($attendee->ticketType != $type) ) { ?>
        <?php $type = $attendee->ticketType; ?>
        <p class="btitle tit<?= $type ?>"><?= $attendee->getTicketTypeValue() ?></p>
    <?php } ?>
    <?php
    $classcont = '';
    if ($isCompanion && ($attendee->idSource != 'C')) {
        $isCompanion = false;
    }
    $double = false;
	if ($verticalBadges) {
		$mainclass = 'badgelabelverticalb';
		$mainclassIn = 'badgelabelverticalinb';
		$contclass = 'badgelabelbcontvertical';
		$insideclass = 'insidebvertical';
	} else {
		$mainclass = 'badgelabelb';
		$mainclassIn = 'badgelabelinb';
		$contclass = 'badgelabelbcont';
		$insideclass = 'insideb';
	}
	if ($isVolunteer && $isEspecial) {
		$class = 'volunteerb';
		$classcont = 'volunteerspecialcont';
		$mainclass = 'badgelabelvertical';
		$mainclassIn = 'badgelabelverticalinb';
		$contclass = 'badgelabelbcontvertical';
		$insideclass = 'insidebvertical';
		$double = true;
	} elseif ($isVolunteer && !$isEspecial) {
		$class = 'volunteerb';
		$classcont = 'volunteercont';
		$mainclass = 'badgelabelvertical';
		$mainclassIn = 'badgelabelverticalinb';
		$contclass = 'badgelabelbcontvertical';
		$insideclass = 'insidebvertical';
		$double = true;
	} elseif (!$isVolunteer && $isEspecial) {
		$class       = 'special';
		$insideclass = 'insideb';
		$double = true;
	} elseif ($isCompanion) {
		$mainclass = 'badgelabel';
		$mainclassIn = 'badgelabelinb';
		$contclass = 'badgelabelbcont';
		$classcont = 'weekendcont';
		$class       = 'companion';
		$double = true;
	} else {
		$mainclass = 'badgelabel';
		$mainclassIn = 'badgelabelinb';
		$contclass = 'badgelabelbcont';
		$class = '';
		$classcont = '';
	}
	if (empty ($classcont)) {
		$classcont = $classcontmap[$attendee->ticketType];
	}

    ?>
    <div class="<?= $contclass ?> <?= $classcont ?>">
        <div class="<?= $mainclass ?> <?= $class ?> <?= $insideclass ?>">
        <span class="<?= $mainclassIn ?>">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimage"/><?php }?>
	        <?= $attendee->memberName ?></span>
        </div>
    </div>
    <?php if ($double) { ?>
        <div class="<?= $contclass ?> <?= $classcont ?>">
            <div class="<?= $mainclass ?> <?= $class ?> <?= $insideclass ?>">
        <span class="<?= $mainclassIn ?>">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimage"/><?php }?>
	        <?= $attendee->memberName ?></span>
            </div>
        </div>
    <?php } ?>
<?php } ?>
</div>
<script src="/assets/a9a1902f/jquery.js"></script>
<script type="text/javascript" src="/js/reportcheckdimensions.js?v1.3"></script>
