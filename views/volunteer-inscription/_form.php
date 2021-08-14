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

    <?= $form->field($model, 'nameFacebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otherVolunteer')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'computersLevel')->dropDownList($computersLevels) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
