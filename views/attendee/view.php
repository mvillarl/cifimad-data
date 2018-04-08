<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\components\AttendeeColumns;

/* @var $this yii\web\View */
/* @var $model app\models\Attendee */

$this->title = $model->memberName;
$this->params['breadcrumbs'][] = ['label' => 'Asistentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Seguro que quieres borrar este asistente?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $attributes = [
        'id',
        [
            'attribute' => 'eventName',
            'format' => 'raw',
            'value'=> Html::a($model->eventName, Url::toRoute(['event/view', 'id' => $model->idEvent]), ['target' => '_blank']),
        ],
        [
            'attribute' => 'memberName',
            'format' => 'raw',
            'value'=> Html::a($model->memberName, Url::toRoute(['member/view', 'id' => $model->idMember]), ['target' => '_blank']),
        ],
        [
            'attribute' => 'status',
            'value' => $model->getStatusValue(),
        ],
        [
            'attribute' => 'ticketType',
            'value' => $model->getTicketTypeValue(),
        ],
        'mealFridayDinner:boolean',
        'mealSaturdayLunch:boolean',
        'mealSaturdayDinner:boolean',
        'mealSundayLunch:boolean',
        'mealSundayDinner:boolean'];
        foreach ($model->getGuestFields() as $field) $attributes[] = $field;
        foreach ($model->getExtraProductFields() as $field) $attributes[] = $field;
    $attributes = array_merge ($attributes, [
        'sourceName',
        'isSpecial:boolean',
        [
            'attribute' => 'roomType',
            'value' => $model->getRoomTypeValue(),
        ],
        'dateStartLodging:date',
        'dateEndLodging:date',
        [
            'attribute' => 'roommate1Name',
            'format' => 'raw',
            'value'=> Html::a($model->roommate1Name, Url::toRoute(['attendee/view', 'id' => $model->idAttendeeRoommate1]), ['target' => '_blank']),
        ],
        [
            'attribute' => 'roommate2Name',
            'format' => 'raw',
            'value'=> Html::a($model->roommate2Name, Url::toRoute(['attendee/view', 'id' => $model->idAttendeeRoommate2]), ['target' => '_blank']),
        ],
        [
            'attribute' => 'roommate3Name',
            'format' => 'raw',
            'value'=> Html::a($model->roommate3Name, Url::toRoute(['attendee/view', 'id' => $model->idAttendeeRoommate3]), ['target' => '_blank']),
        ],
        'parentName',
        'remarks:ntext',
        'remarksRegistration:ntext',
        'remarksMeals:ntext',
        'remarksMealSaturday:ntext',
        'remarksHotel:ntext',
        [
            'attribute' => 'orders',
            //'headerOptions' => ['title' => $extraProductsTitle],
            //'contentOptions' =>  ['style' => 'white-space; nowrap;', 'nowrap' => 'true'],
            'format'=>'raw',
            'value' => AttendeeColumns::orderNumbersCol ($model, '', '', ''),
        ],
        'createdAt',
        'updatedAt',
        'updatedAtHotel',
        'updatedAtBadges',
        'updatedAtBadgesTickets',
    ]);
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>

</div>
