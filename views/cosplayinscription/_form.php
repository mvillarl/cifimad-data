<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CosplayInscription */
/* @var $form yii\widgets\ActiveForm */
/* @var $events array */
/* @var $categories array */

?>

<div class="cosplay-inscription-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEvent')->dropDownList($events) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList($categories) ?>

    <?= $form->field($model, 'characterName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'hasPerformance')->checkbox() ?>

    <?= $form->field($model, 'hasSoundtrack')->checkbox() ?>

    <?= $form->field($model, 'status')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
