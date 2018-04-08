<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttendeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idEvent') ?>

    <?= $form->field($model, 'idMember') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'ticketType')->dropDownList(app\models\Attendee::getTicketTypes() ) ?>

    <?php // echo $form->field($model, 'mealFridayDinner')->checkbox() ?>

    <?php // echo $form->field($model, 'mealSaturdayLunch')->checkbox() ?>

    <?php // echo $form->field($model, 'mealSaturdayDinner')->checkbox() ?>

    <?php // echo $form->field($model, 'mealSundayLunch')->checkbox() ?>

    <?php // echo $form->field($model, 'mealSundayDinner')->checkbox() ?>

    <?php // echo $form->field($model, 'guest1Photoshoot') ?>

    <?php // echo $form->field($model, 'guest1Autograph') ?>

    <?php // echo $form->field($model, 'guest2Photoshoot') ?>

    <?php // echo $form->field($model, 'guest2Autograph') ?>

    <?php // echo $form->field($model, 'guest2Vintage') ?>

    <?php // echo $form->field($model, 'guest3Photoshoot') ?>

    <?php // echo $form->field($model, 'guest3Autograph') ?>

    <?php // echo $form->field($model, 'guest3Vintage') ?>

    <?php // echo $form->field($model, 'idSource') ?>

    <?php // echo $form->field($model, 'isSpecial')->checkbox() ?>

    <?php // echo $form->field($model, 'roomType') ?>

    <?php // echo $form->field($model, 'dateStartLodging') ?>

    <?php // echo $form->field($model, 'dateEndLodging') ?>

    <?php // echo $form->field($model, 'idAttendeeRoommate1') ?>

    <?php // echo $form->field($model, 'idAttendeeRoommate2') ?>

    <?php // echo $form->field($model, 'remarks') ?>

    <?php // echo $form->field($model, 'remarksRegistration') ?>

    <?php // echo $form->field($model, 'remarksMeals') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reiniciar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
