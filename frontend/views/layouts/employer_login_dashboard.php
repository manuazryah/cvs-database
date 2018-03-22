<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\EmployerAssetLogin;
use yii\helpers\Html;

EmployerAssetLogin::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Admin Panel" />
        <link rel="shortcut icon" href="<?= Yii::$app->homeUrl; ?>images/fav.png"/>
        <meta name="author" content="" />
        <title><?= Html::encode($this->title) ?></title>


        <script src="<?= Yii::$app->homeUrl; ?>dash/js/jquery.min.js"></script>
        <?php $this->head() ?>
    </head>
    <body class="page-body login-page login-bg">
        <?php $this->beginBody() ?>

        <?php echo $content; ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
