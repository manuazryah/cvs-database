<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="header-stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="site-logo">
                            <a href="index.php"><img src="<?= Yii::$app->homeUrl ?>images/home/site-logo.png" alt="" class="img-responsive" /></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <nav class="navbar navbar-default navbar-static-top">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav scrollto">
                                    <li><a href="">Home</a></li>
                                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="register-employer.php">My Account <i class=" fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="">User Details</a></li>
                                            <li><?= Html::a('Profile Edit', ['update']) ?></li>
                                            <li><a href="">Online CV</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="">Sign Out</a></li>
                                    <li><a href="#">Hi User Name</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
