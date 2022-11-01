<?php

/* @var $this yii\web\View */
/* @var $model app\models\Poll */
/* @var $csrfName string */
/* @var $csrfValue string */
/* @var $voted boolean */

?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div id="signup-form">
<?php if ($model === null) { ?>
    <h3>No se encuentra esta encuesta</h3>
<?php } elseif ($voted) { ?>
    <h3>Ya has votado en esta encuesta</h3>
    <p><a href="/poll/result/<?= $model->pkey ?>">Ver resultados</a></p>
<?php } else { ?>
    <form method="post" id="form-poll" onsubmit="return sendForm();">
        <input type="hidden" name="<?= $csrfName ?>" value="<?= $csrfValue ?>"/>
        <input type="hidden" name="idPoll" value="<?= $model->id ?>"/>
    <h2><?= $model->title ?></h2>
    <p class="small">Puedes seleccionar una de las opciones existentes, o añadir una nueva.</p>
    <?php foreach ($model->pollAnswers as $pollAnswer) { ?>
        <p><input type="radio" name="idPollAnswer" class="required" value="<?= $pollAnswer->id ?>"> <?= $pollAnswer->answerText ?></p>
    <?php } ?>
    <p><input type="radio" name="idPollAnswer" class="required" value="_new"> <input type="text" name="newAnswerText" size="40" class="poll"/></p>
    <input type="submit" value="Votar"/>
    <p><a href="/poll/result/<?= $model->pkey ?>">Ver resultados</a></p>
    </form>
<?php } ?>
</div>
