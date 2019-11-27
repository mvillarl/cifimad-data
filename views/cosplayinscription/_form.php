<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CosplayInscription */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="cosplay-inscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEvent')->dropDownList($events) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList($model->getCategories() ) ?>

    <?= $form->field($model, 'characterName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
