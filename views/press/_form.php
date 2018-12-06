<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Press */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="press-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSource')->dropDownList($sources) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consent')->checkbox() ?>

    <?= $form->field($model, 'keyCheck')->textInput(['readonly' => 'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
