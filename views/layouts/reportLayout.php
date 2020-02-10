<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $members array */

use yii\helpers\Html;
//use app\assets\AppAsset;

$this->title = $this->context->getReportTitle();
//AppAsset::register($this);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode(Yii::$app->name . ' - ' . $this->title) ?></title>
	<link rel="stylesheet" href="/css/reports.css?v1.12"/>
</head>
<body>

<?= $content ?>

</body>
</html>
