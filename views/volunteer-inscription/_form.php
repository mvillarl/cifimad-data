<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VolunteerInscription */
/* @var $form yii\widgets\ActiveForm */
/* @var $events array */
/* @var $computersLevels array */
?>

<div class="volunteer-inscription-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'idEvent')->dropDownList($events) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nameFacebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otherVolunteer')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'computersLevel')->dropDownList($computersLevels) ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <?= $form->field($model, 'activitiesRequired')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'activitiesDesired')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
