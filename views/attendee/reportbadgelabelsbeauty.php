<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */
/* @var $afterprint boolean */
/* @var $showinfotickets string */
/* @var $blankBadges app\models\Source[] */
/* @var $badgesCifiKids app\models\Attendee[] */
/* @var $verticalBadges boolean */
/* @var $acadiBadges integer */
/* @var $csrfName string */
/* @var $csrfValue string */

$this->title = 'Informe - acreditaciones completas';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$classcontmap = [
        'F' => 'weekendcont',
        'V' => 'fridaycont',
        'S' => 'saturdaycont',
        'D' => 'sundaycont',
];
$titlesunday = false;
?>
<div class="attendee-reportbadgelabels beauty">
    <div style="text-align: center;">
	<div id="progress"></div>
    <input type="button" value="Generar imágenes" class="button" id="generateImgs" disabled="true"/>
    </div>
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
    <?php if ($type == 'D') {$titlesunday = true;} ?>
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
    if ($isVolunteer && ($attendee->sourceName == 'Staff - antiacoso') ) {
        $classcont = 'volunteerantishcont';
    }
	if (empty ($classcont)) {
		$classcont = $classcontmap[$attendee->ticketType];
	}

    ?>
        <div id="att<?= $attendee->id ?>" class="generateJpg" data-name="<?= $attendee->imgFileName . ($double? '1': '') . '.jpg' ?>">
    <div class="<?= $contclass ?> <?= $classcont ?>">
        <div class="<?= $mainclass ?> <?= $class ?> <?= $insideclass ?>">
        <span class="<?= $mainclassIn ?>">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimageb"/><?php }?>
	        <?= $attendee->memberName ?></span>
        </div>
    </div>
        </div>
    <?php if ($double) { ?>
        <div id="att<?= $attendee->id ?>-2" class="generateJpg" data-name="<?= $attendee->imgFileName . '2.jpg' ?>">
        <div class="<?= $contclass ?> <?= $classcont ?>">
            <div class="<?= $mainclass ?> <?= $class ?> <?= $insideclass ?>">
        <span class="<?= $mainclassIn ?>">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $attendee->sourceImageFile ?>" class="sourceimageb"/><?php }?>
	        <?= $attendee->memberName ?></span>
            </div>
        </div>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!$afterprint) { ?>
    <?php if ( ($acadiBadges > 0) && !$titlesunday) { ?>
        <p class="btitle titD">Domingo</p>
        <?php } ?>
    <?php for ($i = 0; $i < $acadiBadges; $i++) { ?>
    <div id="attACADI<?= $i ?>" class="generateJpg" data-name="ACADI<?= $i ?>.jpg">
    <div class="badgelabelbcont sundaycont">
        <div class="badgelabel insideb">
        <span class="badgelabelinb">ACADI  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </div>
    </div>
    </div>
    <?php } ?>
    <?php foreach ($blankBadges as $source) { ?>
        <?php for ($i = 0; $i < $source->blankBadges; $i++) { ?>
            <div id="attBlank<?= $source->id . '-' . $i ?>" class="generateJpg" data-name="Blank<?= $source->id . ' - ' . $i ?>.jpg">
            <div class="badgelabelbcont weekendcont">
                <div class="badgelabel insideb">
        <span class="badgelabelinb">
					<?php if (strlen ($attendee->sourceImageFile) ) { ?><img src="/img/logos/<?= $source->imageFile ?>" class="sourceimageb"/><?php }?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </div>
            </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>

</div>
<form method="post" action="/attendee/generateimgs" name="frmGenerateJpg" id="frmGenerateJpg">
    <input type="hidden" id="csrfField" name="<?= $csrfName ?>" value="<?= $csrfValue ?>"/>
    <input type="hidden" name="step" value="2"/>
</form>
<script src="/assets/a9a1902f/jquery.js"></script>
<script src="/js/html2canvas.min.js"></script>
<script type="text/javascript" src="/js/reportcheckdimensions.js?v1.4"></script>
