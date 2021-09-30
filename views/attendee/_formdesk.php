<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Attendee */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="attendee-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'idEvent')->dropDownList($events,  ['readonly' => 'readonly'])->hint('Vuelve al listado para cambiar de evento') ?>

        <?= $form->field($model, 'idMember')->hiddenInput() ?>
        <?= AutoComplete::widget([
            'name' => 'memberName',
            'value' => $model->memberName,
            'options' => [
                'class' => 'form-control',
                'cf_target' => 'attendee-idmember',
                'cf_source' => '/member/ajaxsearch/',
                'readonly' => 'readonly',
            ],
            'clientOptions' => [
                'minLength'=>'3',
                'autoFill'=>true,
                'select' => new JsExpression('autocompleteSelect'),
                'source' => new JsExpression('autocomplete'),
            ],
        ]); ?>

        <?= $form->field($model, 'status')->dropDownList($model->getStatusMap(), ['readonly' => 'readonly']) ?>

        <?= $form->field($model, 'ticketType')->dropDownList($model->getTicketTypes(), ['readonly' => 'readonly'] ) ?>

        <?= $form->field($model, 'idSource')->dropDownList($sources, ['readonly' => 'readonly']) ?>


        <?= $form->field($model, 'phoneAtDesk')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="control-label">Observaciones acreditaciones</label>
            <p><?= $model->remarksRegistration ?></p>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$this->registerJsFile('/js/autocomplete.js?v1', ['depends' => [\yii\jui\JuiAsset::className()]]);
?>