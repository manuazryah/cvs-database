<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
$jobseaker_count = common\models\Candidate::find()->where(['status' => 1])->count();
$employer_count = common\models\Employer::find()->where(['status' => 1])->count();

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
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5b6ab15be21878736ba2bb0f/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
        <?php $this->head() ?>
        <style>
            .pre-loader {
                background-color: #2c3e50;
                position: fixed;
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
            }
            .sk-fading-circle {
                margin: 100px auto;
                width: 40px;
                height: 40px;
                position: relative;
            }
            .sk-fading-circle .sk-circle {
                width: 100%;
                height: 100%;
                position: absolute;
                left: 0;
                top: 0;
            }
            .sk-fading-circle .sk-circle:before {
                content: '';
                display: block;
                margin: 0 auto;
                width: 15%;
                height: 15%;
                background-color: #fff;
                border-radius: 100%;
                -webkit-animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
                animation: sk-circleFadeDelay 1.2s infinite ease-in-out both;
            }
            .sk-fading-circle .sk-circle2 {
                -webkit-transform: rotate(30deg);
                -ms-transform: rotate(30deg);
                transform: rotate(30deg);
            }
            .sk-fading-circle .sk-circle3 {
                -webkit-transform: rotate(60deg);
                -ms-transform: rotate(60deg);
                transform: rotate(60deg);
            }
            .sk-fading-circle .sk-circle4 {
                -webkit-transform: rotate(90deg);
                -ms-transform: rotate(90deg);
                transform: rotate(90deg);
            }
            .sk-fading-circle .sk-circle5 {
                -webkit-transform: rotate(120deg);
                -ms-transform: rotate(120deg);
                transform: rotate(120deg);
            }
            .sk-fading-circle .sk-circle6 {
                -webkit-transform: rotate(150deg);
                -ms-transform: rotate(150deg);
                transform: rotate(150deg);
            }
            .sk-fading-circle .sk-circle7 {
                -webkit-transform: rotate(180deg);
                -ms-transform: rotate(180deg);
                transform: rotate(180deg);
            }
            .sk-fading-circle .sk-circle8 {
                -webkit-transform: rotate(210deg);
                -ms-transform: rotate(210deg);
                transform: rotate(210deg);
            }
            .sk-fading-circle .sk-circle9 {
                -webkit-transform: rotate(240deg);
                -ms-transform: rotate(240deg);
                transform: rotate(240deg);
            }
            .sk-fading-circle .sk-circle10 {
                -webkit-transform: rotate(270deg);
                -ms-transform: rotate(270deg);
                transform: rotate(270deg);
            }
            .sk-fading-circle .sk-circle11 {
                -webkit-transform: rotate(300deg);
                -ms-transform: rotate(300deg);
                transform: rotate(300deg);
            }
            .sk-fading-circle .sk-circle12 {
                -webkit-transform: rotate(330deg);
                -ms-transform: rotate(330deg);
                transform: rotate(330deg);
            }
            .sk-fading-circle .sk-circle2:before {
                -webkit-animation-delay: -1.1s;
                animation-delay: -1.1s;
            }
            .sk-fading-circle .sk-circle3:before {
                -webkit-animation-delay: -1s;
                animation-delay: -1s;
            }
            .sk-fading-circle .sk-circle4:before {
                -webkit-animation-delay: -0.9s;
                animation-delay: -0.9s;
            }
            .sk-fading-circle .sk-circle5:before {
                -webkit-animation-delay: -0.8s;
                animation-delay: -0.8s;
            }
            .sk-fading-circle .sk-circle6:before {
                -webkit-animation-delay: -0.7s;
                animation-delay: -0.7s;
            }
            .sk-fading-circle .sk-circle7:before {
                -webkit-animation-delay: -0.6s;
                animation-delay: -0.6s;
            }
            .sk-fading-circle .sk-circle8:before {
                -webkit-animation-delay: -0.5s;
                animation-delay: -0.5s;
            }
            .sk-fading-circle .sk-circle9:before {
                -webkit-animation-delay: -0.4s;
                animation-delay: -0.4s;
            }
            .sk-fading-circle .sk-circle10:before {
                -webkit-animation-delay: -0.3s;
                animation-delay: -0.3s;
            }
            .sk-fading-circle .sk-circle11:before {
                -webkit-animation-delay: -0.2s;
                animation-delay: -0.2s;
            }
            .sk-fading-circle .sk-circle12:before {
                -webkit-animation-delay: -0.1s;
                animation-delay: -0.1s;
            }
            @-webkit-keyframes sk-circleFadeDelay {
                0%, 39%, 100% {
                    opacity: 0;
                }
                40% {
                    opacity: 1;
                }
            }
            @keyframes sk-circleFadeDelay {
                0%, 39%, 100% {
                    opacity: 0;
                }
                40% {
                    opacity: 1;
                }
            }
        </style>
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
                    <div class="col-md-9">
                        <div class="text-right who">
                            <?php //<?= Html::a('Employer', ['/employer/index'], ['class' => 'login active']) ?>
                            <?= Html::a('Jobseeker', ['/site/index'], ['class' => 'signup active']) ?>
                        </div>
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
                                    <li><?= Html::a('Home', ['/employer/index']) ?></li>
                                    <li><?= Html::a('Pricing', ['/employer/pricing']) ?></li>
                                    <li><?= Html::a('Contact Us', ['/employer/contact']) ?></li>
                                </ul>
                            </div>
                        </nav>
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
                             <li><?= Html::a('Blog', ['/employer/blog']) ?></li>
                            <li><a href="">Careers with Us</a></li>
                            <li><a href="">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="footer-block">
                        <h5>For Jobseekers</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><?= Html::a('Register', ['/site/index']) ?></li>
                            <li><?= Html::a('Sign in', ['/site/index']) ?></li>
                            <li><a href="">FAQ - Jobseeker</a></li>
                        </ul>
                    </div>
                    <div class="footer-block">
                        <h5>For Employers</h5>
                        <hr>
                        <ul class="footer-link">
                            <li><?= Html::a('Register', ['/employer/index']) ?></li>
                            <li><?= Html::a('Sign in', ['/employer/index']) ?></li>
                            <li><a href="">FAQ - Employer</a></li>
                        </ul>
                    </div>
                        
                    <div class="footer-block footer-block2">
                        <h5>Follow Us</h5>
                        <hr>
                        <ul class="follow">
                            <li><a href="https://www.facebook.com/" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com/" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://in.linkedin.com/" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
<!--                            <li><a href="#" title="Google"><i class="fa fa-google-plus"></i></span></a></li>
                            <li><a href="#" title="RSS"><i class="fa fa-rss"></i></a></li>-->
                        </ul>
                        <div class="border"></div>
                        <div class="register">
                            <a href=""><?= $jobseaker_count ?> <span>Reg Jobseekers</span></a>
                        </div>
                        <div class="register job">
                            <a href=""><?= $employer_count ?> <span>Reg Employers</span></a>
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
                       
                    </div>
                </div>
            </div>
        </footer>
        <div class="pre-loader">
            <div class="sk-fading-circle">
                <div class="sk-circle1 sk-circle"></div>
                <div class="sk-circle2 sk-circle"></div>
                <div class="sk-circle3 sk-circle"></div>
                <div class="sk-circle4 sk-circle"></div>
                <div class="sk-circle5 sk-circle"></div>
                <div class="sk-circle6 sk-circle"></div>
                <div class="sk-circle7 sk-circle"></div>
                <div class="sk-circle8 sk-circle"></div>
                <div class="sk-circle9 sk-circle"></div>
                <div class="sk-circle10 sk-circle"></div>
                <div class="sk-circle11 sk-circle"></div>
                <div class="sk-circle12 sk-circle"></div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script>
    (function ($) {
        'use strict';
        $(window).on('load', function () {
            if ($(".pre-loader").length > 0)
            {
                $(".pre-loader").fadeOut("slow");
            }
        });
    })(jQuery)
</script>
