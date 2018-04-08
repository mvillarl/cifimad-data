<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Guest */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="guest-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idEvent')->dropDownList($events) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'characterName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'nif_passport')->textInput() ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarksMeals')->textarea(['rows' => 6]) ?>

    <?=  $form->field($model, 'dateArrival')->widget(\yii\jui\DatePicker::classname(),[
        //'dateFormat' => 'yyyy-mm-dd',
        //'options' => ['class' => 'cfdp', 'cf_lessthan' => 'guest-datedeparture']
    ]); ?>

    <?=  $form->field($model, 'dateDeparture')->widget(\yii\jui\DatePicker::classname(),[
        //'dateFormat' => 'yyyy-mm-dd',
        //'options' => ['class' => 'cfdp', 'cf_greaterthan' => 'guest-datearrival']
    ]); ?>

    <?= $form->field($model, 'hasAutograph')->checkbox() ?>

    <?= $form->field($model, 'hasAutographSpecial')->checkbox() ?>

    <?= $form->field($model, 'hasPhotoshoot')->checkbox() ?>

    <?= $form->field($model, 'hasPhotoshootSpecial')->checkbox() ?>

    <?= $form->field($model, 'hasVintage')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile('/js/datepickerinterval.js', ['depends' => [\yii\jui\DatePickerLanguageAsset::className()]]);
?>
