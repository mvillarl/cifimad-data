<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe - reservas de aparcamiento';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attendee-reporthotel">
    <table class="reporthoteltable" cellpadding="2" cellspacing="2">
        <thead>
        <tr>
            <th></th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Coche</th>
            <th>Matrícula</th>
            <th>Especial</th>
        </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($attendees as $attendee) { ?>
                <?php $parkingparts = explode (' - ', $attendee->parkingReservation); if (count ($parkingparts) == 1) $parkingparts = ['', $parkingparts[0] ]; $i++; ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $attendee->name ?></td>
                    <td><?= $attendee->surname ?></td>
                    <td><?= $attendee->memberPhone ?></td>
                    <td><?= $parkingparts[0] ?></td>
                    <td><?= $parkingparts[1] ?></td>
                    <td><?php if ($attendee->getParkingOptionsValue() != '') { ?><?= $attendee->getParkingOptionsValue() ?><?php } ?></td>
                </tr>
            <?php } ?>
        </tr>
        </tbody>
    </table>
</div>