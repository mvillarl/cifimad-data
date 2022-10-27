<?php

/* @var $this yii\web\View */
/* @var $model app\models\Poll */
/* @var $votedok boolean */

?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="signup-form">
    <?php if ($model === null) { ?>
        <h3>No se encuentra esta encuesta</h3>
    <?php } else { ?>
        <?php if ($votedok) { ?>
            <p class="message">¡Gracias por darnos tu opinión!</p>
        <?php } ?>
        <h2><?= $model->title ?></h2>
        <?php foreach ($model->pollAnswers as $pollAnswer) { ?>
            <p> <?= $pollAnswer->answerText ?> - <span class="result"><?= $pollAnswer->votes ?> (<?= $pollAnswer->votesPercentage ?>%)</span></p>
        <?php } ?>
    <?php } ?>
</div>
