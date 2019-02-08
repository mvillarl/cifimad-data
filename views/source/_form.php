<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Source */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="source-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php if (strlen ($model->imageFile)) { ?>
        <img src="/img/logos/<?= $model->imageFile ?>"/>
    <?php } ?>

    <?= $form->field($model, 'imageFileObj')->fileInput() ?>

    <?= $form->field($model, 'separateList')->checkbox() ?>

    <?= $form->field($model, 'blankBadges')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
