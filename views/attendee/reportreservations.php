<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe -  reservas a ' . date('d/m/Y');
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attendee-reportreservations">
    <h2><?= $this->title ?></h2>
    <table>
        <?php if ($fridayDinner > 0) { ?>
        <tr>
            <td>Cenas cocktail</td>
            <td><?= $fridayDinner; ?></td>
        </tr>
        <?php } ?>
        <?php if ($saturdayDinner > 0) { ?>
        <tr>
            <td>Cenas de gala</td>
            <td><?= $saturdayDinner; ?></td>
        </tr>
        <?php } ?>
        <?php if ($saturdayLunch > 0) { ?>
        <tr>
            <td>Comidas sábado</td>
            <td><?= $saturdayLunch; ?></td>
        </tr>
        <?php } ?>
        <?php if ($sundayLunch > 0) { ?>
        <tr>
            <td>Comidas domingo</td>
            <td><?= $sundayLunch; ?></td>
        </tr>
        <?php } ?>
        <?php if ($sundayDinner > 0) { ?>
        <tr>
            <td>Cenas de los Valientes</td>
            <td><?= $sundayDinner; ?></td>
        </tr>
        <?php } ?>
        <tr>
            <td>Habitaciones</td>
            <td><?= $lodgingSuites + $lodgingSingles + $lodgingDoubles + $lodgingTriples + $lodgingQuadruples; ?><br/>
                <table>
                <?php if ($lodgingSuites > 0) { ?>
                <tr>
                    <td>Suites</td>
                    <td><?= $lodgingSuites; ?></td>
                </tr>
                <?php } ?>
                <?php if ($lodgingSingles > 0) { ?>
                <tr>
                    <td>Individuales</td>
                    <td><?= $lodgingSingles; ?></td>
                </tr>
                <?php } ?>
                <?php if ($lodgingDoubles > 0) { ?>
                <tr>
                    <td>Dobles</td>
                    <td><?= $lodgingDoubles; ?></td>
                </tr>
                <?php } ?>
                <?php if ($lodgingTriples > 0) { ?>
                <tr>
                    <td>Triples</td>
                    <td><?= $lodgingTriples; ?></td>
                </tr>
                <?php } ?>
                <?php if ($lodgingQuadruples > 0) { ?>
                <tr>
                    <td>Cuádruples</td>
                    <td><?= $lodgingQuadruples; ?></td>
                </tr>
                <?php } ?>
                    <tr>
                        <td>Reservas de aparcamiento</td>
                        <td><?= $parking; ?></td>
                    </tr>
                </table></td>
        <tr>
            <td>Entradas</td>
            <td><?= $ticketsFriday + $ticketsSaturday + $ticketsSunday + $ticketsWeekend; ?><br/>
                <table>
                    <?php if ($ticketsFriday > 0) { ?>
                    <tr>
                        <td>Viernes</td>
                        <td><?= $ticketsFriday ?></td>
                    </tr>
                    <?php } ?>
                    <?php if ($ticketsSaturday > 0) { ?>
                    <tr>
                        <td>Sábado</td>
                        <td><?= $ticketsSaturday ?></td>
                    </tr>
                    <?php } ?>
                    <?php if ($ticketsSunday > 0) { ?>
                    <tr>
                        <td>Domingo</td>
                        <td><?= $ticketsSunday ?></td>
                    </tr>
                    <?php } ?>
                    <?php if ($ticketsWeekend > 0) { ?>
                    <tr>
                        <td>Fin de semana</td>
                        <td><?= $ticketsWeekend ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
    </table>
</div>
