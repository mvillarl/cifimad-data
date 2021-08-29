<?php

use app\models\Attendee;

/* @var $this yii\web\View */
/* @var $attendees app\models\Attendee[] */

$this->title = 'Informe - reservas de aparcamiento';
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="attendee-reportparking">
	<?php foreach ($attendees as $attendee) { ?>
		<div class="parking">
			<?php $parkingparts = explode (' - ', $attendee->parkingReservation); ?>
			<?= $parkingparts[0]; ?>
			<?php if (!empty ($parkingparts[1])) { ?>
				<br/><?= $parkingparts[1]; ?>
			<?php } ?>
		</div>
	<?php } ?>

</div>
