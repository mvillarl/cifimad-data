<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
//$this->registerJsFile('/js/datepickerinterval.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->dropDownList($model->getYears() ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'dateStart')->widget(\yii\jui\DatePicker::classname(),[
            'dateFormat' => 'dd/MM/yyyy',
            'options' => ['class' => 'cfdp', 'cf_lessthan' => 'event-dateend']
    ]); ?>
    <?=  $form->field($model, 'dateEnd')->widget(\yii\jui\DatePicker::classname(),[
            'dateFormat' => 'dd/MM/yyyy',
        'options' => ['class' => 'cfdp', 'cf_greaterthan' => 'event-datestart']
    ]); ?>

	<?= $form->field($model, 'isPandemic')->checkbox() ?>

    <?= $form->field ($model, 'dateSentInfoHotel')->label()->hint('Marca la casilla para guardar la fecha y hora actual')->textInput( ['readonly' => 'readonly']); ?>
    <?= Html::checkbox('dateSentInfoHotelNow'); ?>

    <?= $form->field ($model, 'dateBadgesPrinted')->label()->hint('Marca la casilla para guardar la fecha y hora actual')->textInput( ['readonly' => 'readonly']); ?>
    <?= Html::checkbox('dateBadgesPrintedNow'); ?>

    <?=  $form->field($model, 'dateEndCosplaySignup')->widget(\yii\jui\DatePicker::classname(),[
	    'dateFormat' => 'dd/MM/yyyy',
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile('/js/datepickerinterval.js', ['depends' => [\yii\jui\DatePickerLanguageAsset::className()]]);
?>
