<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PollAnswer */
/* @var $form yii\widgets\ActiveForm */
/* @var $polls app\models\Poll[] */
?>

<div class="poll-answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idPoll')->dropDownList($polls) ?>

    <?= $form->field($model, 'answerText')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
