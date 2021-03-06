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

        <div class="header-stricky jobseeker-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
                        <div class="site-logo">
                            <a href="index.php"><img src="<?= Yii::$app->homeUrl ?>images/home/site-logo.png" alt="" class="img-responsive" /></a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <nav class="navbar navbar-default navbar-static-top">
                            <a class="site-logo hidden-lg hidden-md visible-sm visible-xs" href="index.php"><img src="<?= Yii::$app->homeUrl ?>images/home/site-logo.png" alt="" class="img-responsive" /></a>
                            <div class=" hidden-lg hidden-md">   
                                <?php
                                echo '<i>'
                                . Html::beginForm(['/candidate/logout'], 'post', ['style' => '', 'class' => 'sign-out']) . '<a>'
                                . Html::submitButton(
                                        '<i class="fa fa-sign-out" aria-hidden="true"></i> Sign out', ['class' => '', 'style' => '']
                                ) . '</a>'
                                . Html::endForm()
                                . '</i>';
                                ?>
                            </div>
                            <!--                            <div class="navbar-header">
                                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                                <span class="sr-only">Toggle navigation</span>
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                                <span class="icon-bar"></span>
                                                            </button>
                                                        </div>-->
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav scrollto">
                                    <li class="dropdown user-prfile-img hidden-sm hidden-xs"><a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><img width="20" height="20" src="<?= Yii::$app->homeUrl ?>images/icons/user-icon-3.svg" alt="" class="img-responsive" /> Hi <b><?= Yii::$app->session['candidate']['id'] != '' ? Yii::$app->session['candidate']['user_name'] : '' ?></b> <i class=" fa fa-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><?= Html::a('My Account', ['/candidate/update-profile']) ?></li>
                                            <?php
                                            echo '<li>'
                                            . Html::beginForm(['/candidate/logout'], 'post', ['style' => '', 'class' => 'sign-out']) . '<a>'
                                            . Html::submitButton(
                                                    'Sign out', ['class' => '', 'style' => '']
                                            ) . '</a>'
                                            . Html::endForm()
                                            . '</li>';
                                            ?>
                                        </ul>
                                    </li>
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

<script>
    $(document).ready(function () {
        $(window).bind('scroll', function () {
            var navHeight = $(window).height() - 300;
            if ($(window).scrollTop() > navHeight) {
                $('.header-stricky').addClass('fixed');
            } else {
                $('.header-stricky').removeClass('fixed');
            }
        });
        $(window).bind('scroll', function () {
            var navHeight = $(window).height() - 300;
            if ($(window).scrollTop() > navHeight) {
                $('aside').addClass('fixed');
            } else {
                $('aside').removeClass('fixed');
            }
        });
    });
</script>
<script>
    $('.ui-dropdown').menu().hide();

    $('#city-info .ui-dropper').button().click(function () {
        // data-drop value and create ID to target dropdown
        var menu = $('#' + $(this).attr('data-drop'));

        // hide all OTHER dropdowns when we open one
        $('.ui-menu:visible').not('#' + $(this).attr('data-drop')).hide();

        // position the dropdown to the right, so it works on all buttons
        // buttons at far right of screen will have menus flipped inward to avoid viewport collision
        menu.toggle().position({
            my: "right top",
            at: "right top",
            of: this
        });
        // on click of the document, close the menus
        $(document).one("click", function () {
//                                                            $('.ui-menu:visible').hide();
        });
        return false;
    });
</script>