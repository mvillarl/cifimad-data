<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Press */

$this->title = 'Actualizar Medio de prensa: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Medios de prensa', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="press-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'sources' => $sources,
    ]) ?>

</div>
