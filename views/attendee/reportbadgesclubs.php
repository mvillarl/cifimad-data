<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe - Reservas';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$rowsperpage = 85;

?>
<div class="attendee-reportbadges">
    <?php for ($i = 0, $ct = count ($attendees), $club = ''; $i < $ct; $i++) { ?>
    <?php if ($club != $attendees[$i]->idSource) { ?>
    <?php if (strlen ($club)) { ?>
    </tbody>
    </table>
</div>
    <p class="pagebreak"> </p>
<div class="attendee-reportbadges">
    <?php } ?>
    <p class="title"><?php echo $attendees[$i]->sourceName; ?></p>
    <table class="attendee-reportbadges" cellpadding="1" cellspacing="1">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Nombre acreditación</th>
            <th>Tipo pase</th>
            <th>Observaciones</th>
        </tr>
        </thead>
        <tbody>
        <?php $club = $attendees[$i]->idSource; } ?>
        <tr class="<?php if ($attendees[$i]->status == '0') echo 'notconfirmed'; else echo ($i % 2)? 'even': 'odd' ?>">
            <td><?= $attendees[$i]->name ?></td>
            <td><?= $attendees[$i]->surname ?></td>
            <td><?= $attendees[$i]->badgeName ?> <?= $attendees[$i]->badgeSurname ?></td>
            <td class="badge<?= $attendees[$i]->ticketType ?>"><?= $attendees[$i]->getTicketTypeValue() ?></td>
            <td><?= $attendees[$i]->remarksRegistration ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
