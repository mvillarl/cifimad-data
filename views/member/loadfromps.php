<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Cargar socios desde '.$shop;
$this->params['breadcrumbs'][] = ['label' => 'Socios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="member-load">
	<?php if ( ($filter == 'a') || ($filter == 'n') ) { ?>
		<div class="alert alert-info text-center">
		Resultado: <?= $upsertTotal ?> clientes procesados
			<?php if ($upsertInserted) { ?>
			, <?= $upsertInserted ?> insertados
			<?php } ?>
			<?php if ($upsertModified) { ?>
			, <?= $upsertModified ?> modificados
			<?php } ?>
			<?php if ($upsertWithErrors) { ?>
			, <?= $upsertWithErrors ?> con errores
			<?php } ?>
		</div>
		<?php if ($upsertWithErrors) { ?>
			<div class="alert alert-danger">
				<?php foreach ($errors as $email => $error) { ?>
					Usuario <?= $email ?>: <ul>
				    <?php foreach ($error as $field => $errorin ) { ?>
					<?php foreach( $errorin as $msg) { ?>
						<li><?= $msg ?></li>
					<?php } ?>
				<?php } ?>
					</ul><br/>
				<?php } ?>
			</div>
		<?php } ?>
	<?php } else { ?>
		<?php if (strlen ($tdate) ) { ?>
			<p>La última carga desde <?= $shop ?> fue el <?= $tdate ?>. Desde entonces hay
				<?= $ncustomers ?> clientes en total, <?= $newcustomers ?> nuevos y <?= $existingcustomers ?> existentes.</p>
		<?php } else { ?>
		<p>Aún no se han cargado datos desde <?= $shop ?>. Hay <?= $ncustomers ?> clientes en total, <?= $newcustomers ?> nuevos
			y <?= $existingcustomers ?> existentes.</p>
		<?php } ?>
		<?php if ($ncustomers > 0) { ?>
		<?= Html::a('Cargar todos', ['member/'.$command, 'filter' => 'a'], ['class' => 'btn btn-primary']) ?>
		<?php } ?>
		<?php if ($newcustomers > 0) { ?>
		<?= Html::a('Cargar sólo nuevos', ['member/'.$command, 'filter' => 'n'], ['class' => 'btn btn-primary']) ?>
		<?php } ?>
		<?php if ($existingcustomers > 0) { ?>
		<?= Html::a('Revisar existentes', ['member/'.$command, 'filter' => 'rn'], ['class' => 'btn btn-primary']) ?>
		<?php } ?>
		<?php if ($filter == 'rn') { ?>
			<h3>Clientes de la tienda que ya existen como socios</h3>
			<?= GridView::widget([
				'dataProvider' => $matching,
				'columns' => [
					['class' => 'yii\grid\SerialColumn'],

					//'id',
					'firstname',
					'lastname',
					'email:email',
					'phone_mobile',
					'dni',
					// 'createdAt',
					// 'updatedAt',

					['class' => 'app\components\PS2CustomerGridActionColumn',
						'visibleButtons' => ['update' => false, 'delete' => false]
					],
				],
			]); ?>
		<?php } ?>
	<?php } ?>
</div>