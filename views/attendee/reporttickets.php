<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */
/* @var $fields string[] */
/* @var $pfields string[] */
/* @var $model app\models\Attendee */
/* @var $showInTickets string */

$this->title = 'Informe - tickets';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attendee-reportbadgelabels">
    <table class="attendee-reportbadgelabels attendee-reporttickets" cellpadding="0" cellspacing="0">
        <?php foreach ($attendees as $attendee) { ?>
        <tr>
            <th><?= $attendee->memberName ?></span></th>
            <td><table class="attendee-reporttickets-inside">
                    <?php if ($attendee->mealFridayDinner) { ?>
                    <tr>
                        <td style="background-color: orange;">Cena viernes</td>
                    </tr>
                    <?php } ?>
                    <?php if ($attendee->mealSaturdayDinner) { ?>
                    <tr>
                        <td style="background-color: white; color: darkred;">Cena de gala<br/> <?= $attendee->remarksMealSaturday ?></td>
                    </tr>
                    <?php } ?>
                    <?php if ($attendee->mealSaturdayLunch) { ?>
                    <tr>
                        <td style="background-color: palegreen; color: darkgreen;">Comida sábado</td>
                    </tr>
                    <?php } ?>
                    <?php if ($attendee->mealSundayLunch) { ?>
                    <tr>
                        <td style="background-color: palegreen;">Comida domingo</td>
                    </tr>
                    <?php } ?>
                    <?php if ($attendee->mealSundayDinner) { ?>
                    <tr>
                        <td style="background-color: #B8FBB8; color: red;">Cena de los Valientes</td>
                    </tr>
                <?php } ?>
                <?php foreach ($fields as $field) {?>
                    <?php if ($attendee->{$field}) { ?>
                        <tr>
                            <td style="background-color: <?= $model->getGuestFieldColor ($field) ?>"><?= $model->getAttributeLabel($field) ?>
                            <?php if ($attendee->{$field} > 1) { ?> (<?= $attendee->{$field} ?>)<?php } ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <?php foreach ($pfields as $field) { ?>
                    <?php if ($attendee->{$field}) { ?>
                        <td style="background-color: <?= $model->getExtraProductFieldColor ($field) ?>;"><?= str_replace (' ', '<br/>', $model->getShortAttributeLabel($field) ) ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
                <?php if ($attendee->isVIP && (in_array($showInTickets, ['V', 'B']))) { ?>
                    <tr>
                        <td style="background-color: #FFF701;">Regalo VIP</td>
                    </tr>
                <?php } ?>
                <?php if ($attendee->sourceIsVolunteer && (in_array($showInTickets, ['S', 'B']))) { ?>
                    <tr>
                        <td style="background-color: #e0705a;">Regalo staff</td>
                    </tr>
                <?php } ?>
                </table></td>
        </tr>
    <?php } ?>
    </table>
</div>