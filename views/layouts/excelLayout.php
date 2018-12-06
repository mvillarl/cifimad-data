<?php
/* @var $this \yii\web\View */
/* @var $content string */
/* @var $members array */

use yii\helpers\Html;

$this->title = 'Datos CifiMad';
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="content-type" content="application/vnd.ms-excel; charset=<?= Yii::$app->charset ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= Html::encode(Yii::$app->name . ' - ' . $this->title) ?></title>
</head>
<body>

<?= $content ?>

</body>
</html>