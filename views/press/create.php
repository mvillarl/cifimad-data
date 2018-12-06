<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Press */

$this->title = 'Crear Medio de prensa';
$this->params['breadcrumbs'][] = ['label' => 'Medios de prensa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="press-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sources' => $sources,
    ]) ?>

</div>
