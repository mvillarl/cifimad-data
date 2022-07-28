<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use app\models\Attendee;

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
        ],
        'clientOptions' => [
            'minLength'=>'3',
            'autoFill'=>true,
            'select' => new JsExpression('autocompleteSelect'),
            'source' => new JsExpression('autocomplete'),
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusMap() ) ?>

    <?= $form->field($model, 'ticketType')->dropDownList($model->getTicketTypes() ) ?>

    <?= $form->field($model, 'idSource')->dropDownList($sources) ?>

    <fieldset class="form-inline">

    <?= $form->field($model, 'mealFridayDinner')->checkbox() ?>    &nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'mealSaturdayLunch')->checkbox() ?>        &nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'mealSaturdayDinner')->checkbox() ?>        &nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'mealSundayLunch')->checkbox() ?>        &nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'mealSundayDinner')->checkbox() ?>

    </fieldset>
    <table class="form-group" width="100%">

    <?php $i = 0; foreach ($model->getGuestFields() as $field) { ?>
        <?php if ( ($i % 2) == 0) { ?> <tr><?php } ?>
    <td><?= $form->field($model, $field)->textInput(['class' => 'col-3']) ?></td>
            <?php if ( ($i % 2) == 1) { ?> </tr><?php } $i++; ?>
    <?php } ?>

    <?php foreach ($model->getExtraProductFields() as $field) { ?>
        <?php if ( ($i % 2) == 0) { ?> <tr><?php } ?>
    <td class="col-3"><?= $form->field($model, $field)->textInput(['class' => 'col-3']) ?></td>
        <?php if ( ($i % 2) == 1) { ?> </tr><?php } $i++; ?>
    <?php } ?>

    </table>

    <?= $form->field($model, 'isSpecial')->checkbox() ?>

    <?= $form->field($model, 'isCifiKidsVolunteer')->checkbox() ?>

    <?= $form->field($model, 'roomType')->dropDownList($model->getRoomTypes() ) ?>

    <?=  $form->field($model, 'dateStartLodging')->widget(\yii\jui\DatePicker::classname(),[
        'dateFormat' => 'dd/MM/yyyy',
        'options' => ['class' => 'cfdp', 'cf_lessthan' => 'attendee-dateendlodging']
    ]); ?>

    <?=  $form->field($model, 'dateEndLodging')->widget(\yii\jui\DatePicker::classname(),[
        'dateFormat' => 'dd/MM/yyyy',
        'options' => ['class' => 'cfdp', 'cf_greaterthan' => 'attendee-datestartlodging']
    ]); ?>

    <fieldset class="form-inline">

    <?= $form->field($model, 'idAttendeeRoommate1')->hiddenInput() ?>
    <?= AutoComplete::widget([
        'name' => 'roommate1Name',
        'value' => $model->roommate1Name,
        'options' => [
            'class' => 'form-control',
            'cf_target' => 'attendee-idattendeeroommate1',
            'cf_source' => '/attendee/ajaxsearch/',
        ],
        'clientOptions' => [
            'minLength'=>'0',
            'autoFill'=>true,
            'select' => new JsExpression('autocompleteSelect'),
            'source' => new JsExpression('autocomplete'),
        ],
    ]); ?>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'idAttendeeRoommate2')->hiddenInput() ?>
    <?= AutoComplete::widget([
        'name' => 'roommate2Name',
        'value' => $model->roommate2Name,
        'options' => [
            'class' => 'form-control',
            'cf_target' => 'attendee-idattendeeroommate2',
            'cf_source' => '/attendee/ajaxsearch/',
        ],
        'clientOptions' => [
            'minLength'=>'0',
            'autoFill'=>true,
            'select' => new JsExpression('autocompleteSelect'),
            'source' => new JsExpression('autocomplete'),
        ],
    ]); ?>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'idAttendeeRoommate3')->hiddenInput() ?>
    <?= AutoComplete::widget([
        'name' => 'roommate3Name',
        'value' => $model->roommate3Name,
        'options' => [
            'class' => 'form-control',
            'cf_target' => 'attendee-idattendeeroommate3',
            'cf_source' => '/attendee/ajaxsearch/',
        ],
        'clientOptions' => [
            'minLength'=>'0',
            'autoFill'=>true,
            'select' => new JsExpression('autocompleteSelect'),
            'source' => new JsExpression('autocomplete'),
        ],
    ]); ?>

    </fieldset>

    <?= $form->field($model, 'idAttendeeParent')->hiddenInput()->hint ('Si el invitado es un niño, asociar aquí con su padre, madre o guardián')  ?>
    <?= AutoComplete::widget([
        'name' => 'parentName',
        'value' => $model->parentName,
        'options' => [
            'class' => 'form-control',
            'cf_target' => 'attendee-idattendeeparent',
            'cf_source' => '/attendee/ajaxsearch/',
        ],
        'clientOptions' => [
            'minLength'=>'0',
            'autoFill'=>true,
            'select' => new JsExpression('autocompleteSelect'),
            'source' => new JsExpression('autocomplete'),
        ],
    ]) ?>

	<?= $form->field($model, 'cifiKidsDay')->dropDownList($model->getCifiKidsDays() ) ?>

	<?= $form->field($model, 'parkingReservation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parkingOptions')->radioList(Attendee::getParkingOptions() ) ?>

	<?= $form->field($model, 'phoneAtDesk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarks')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarksRegistration')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarksMeals')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarksMealSaturday')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remarksHotel')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'orders')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remarksOrPendingPaymentDone')->checkbox() ?>

    <?= $form->field($model, 'createdAt')->textInput( ['readonly' => 'readonly']) ?>

    <?= $form->field($model, 'updatedAt')->textInput( ['readonly' => 'readonly']) ?>

    <?php if (strlen ($model->id)) { ?>
    <?= Html::checkbox('updateHotelFlag', false, ['id' => 'updateHotelFlag', 'label' => 'Actualizar fecha de modificación - datos hotel']) ?>
    <?php } ?>

    <?= $form->field($model, 'updatedAtHotel')->textInput( ['readonly' => 'readonly']) ?>

    <?php if (strlen ($model->id)) { ?>
    <?= Html::checkbox('updateBadgesFlag', false, ['id' => 'updateBadgesFlag', 'label' => 'Actualizar fecha de modificación - acreditación']) ?>
    <?php } ?>

    <?= $form->field($model, 'updatedAtBadges')->textInput( ['readonly' => 'readonly']) ?>

    <?php if (strlen ($model->id)) { ?>
    <?= Html::checkbox('updateBadgesTicketsFlag', false, ['id' => 'updateBadgesTicketsFlag', 'label' => 'Actualizar fecha de modificación - acreditación y tickets']) ?>
    <?php } ?>

    <?= $form->field($model, 'updatedAtBadgesTickets')->textInput( ['readonly' => 'readonly']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Añadir' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile('/js/datepickerinterval.js', ['depends' => [\yii\jui\DatePickerLanguageAsset::className()]]);
$this->registerJsFile('/js/autocomplete.js?v1', ['depends' => [\yii\jui\JuiAsset::className()]]);
$this->registerJsFile('/js/checkboxes.js?v1', ['depends' => [\yii\jui\JuiAsset::className()]]);
?>