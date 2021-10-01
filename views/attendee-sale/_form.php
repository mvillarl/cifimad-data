<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AttendeeSale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendee-sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEvent')->dropDownList($events,  ['readonly' => 'readonly'])->hint('Vuelve al listado para cambiar de evento') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ticketType')->dropDownList($model->getTicketTypes() ) ?>

    <?= $form->field($model, 'vaccine')->dropDownList($model->getVaccineOptions() ) ?>

    <div class="xform-control"><label>Estos campos sólo son necesarios para acreditados que no compren pase</label></div>

    <?= $form->field($model, 'authorizedBy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authorizedReason')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
