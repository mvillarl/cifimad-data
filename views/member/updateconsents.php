<?php
$this->title = 'Actualizar consentimientos';
$this->params['breadcrumbs'][] = ['label' => 'Socios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="member-load">
	<div class="alert alert-info text-center">
		Resultado: <?= $modified ?> consentimientos actualizados
		<?php if ($withErrors) { ?>
			, <?= $withErrors ?> con errores
		<?php } ?>
	</div>
	<?php if ($withErrors) { ?>
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
</div>