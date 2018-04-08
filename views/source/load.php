<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cargar procedencias';
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="source-load">

	<p class="error"><?= $error ?></p>
	<p>Introduce una procedencia en cada línea</p>
	<?php $form = ActiveForm::begin(); ?>

	<?= Html::textArea('sources', '', ['rows' => '10', 'cols' => '70']) ?>

	<div class="form-group">
		<?= Html::submitButton('Cargar', ['class' => 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
