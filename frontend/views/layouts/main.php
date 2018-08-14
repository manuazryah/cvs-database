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
        <script src="<?= Yii::$app->homeUrl ?>js/jquery3.1.js"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="header-stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="site-logo">
                            <a href=""><img src="<?= Yii::$app->homeUrl ?>images/home/site-logo.png" alt="" class="img-responsive" /></a>
                        </div>
                    </div>
<!--                    <div class="col-md-6">
                        <nav class="navbar navbar-default navbar-static-top">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                        </nav>
                    </div>-->
                    <div class="col-md-3 text-right who fright">
                        <?php //<?= Html::a('Jobseeker', ['/site/index'], ['class' => 'login active']) ?>
                        <?= Html::a('Employer', ['/employer/index'], ['class' => 'signup active']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?= $content ?>
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="footer-block">
                        <h5>Information</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><?= Html::a('About us', ['/site/about']) ?></li>
                            <li><?= Html::a('Conditions', ['/site/conditions']) ?></li>
                            <li><?= Html::a('Privacy policy', ['/site/privacy-policy']) ?></li>
                            <li><a href="#">Careers with Us</a></li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="footer-block">
                        <h5>For Jobseekers</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><a href="#">Submit CV's</a></li>
                            <li><a href="#">Register</a></li>
                            <li><a href="#">Sign in</a></li>
                            <li><a href="#">FAQ - Jobseeker</a></li>
                        </ul>
                    </div>
                    <div class="footer-block">
                        <h5>For Employers</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><a href="#">Search CVs</a></li>
                            <li><a href="#">Register</a></li>
                            <li><a href="#">Sign in</a></li>
                            <li><a href="#">FAQ - Employer</a></li>
                        </ul>
                    </div>
                    <div class="footer-block">
                        <h5>Browse Jobs</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><a href="#">Browse All Jobs</a></li>
                            <li><a href="#">Govt. Jobs</a></li>
                            <li><a href="#">International Jobs</a></li>
                            <li><a href="#">Jobs by Company</a></li>
                        </ul>
                    </div>
                    <div class="footer-block footer-block2">
                        <h5>Follow Us</h5>
                        <hr>
                        <ul class="follow">
                            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
<!--                            <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></span></a></li>
                            <li><a href="#" title="RSS"><i class="fa fa-rss"></i></a></li>-->
                        </ul>
                        <div class="border"></div>
                        <div class="register">
                            <a href="#">8,368,480 <span>Reg Jobseekers</span></a>
                        </div>
                        <div class="register job">
                            <a href="#">1,50,000 <span>Reg Employers</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 padding-left">
                            <span>&#169; 2018 CVs Database. All rights reserved.</span>
                        </div>
                        <!--                        <div class="col-md-6 col-sm-6 text-right padding-left">
                                                    <ul class="bottom_link">
                                                        <li><a href="#">Link 1</a></li>
                                                        <li><a href="#">Link 1</a></li>
                                                        <li><a href="#">Link 1</a></li>
                                                    </ul>
                                                </div>-->
                    </div>
                </div>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function () {
        $(window).bind('scroll', function () {
            var navHeight = $(window).height();
            if ($(window).scrollTop() > navHeight) {
                $('.header-stricky').addClass('fixed');
            } else {
                $('.header-stricky').removeClass('fixed');
            }
        });
    });
</script>
