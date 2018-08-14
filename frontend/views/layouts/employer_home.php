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
                                    <li><?= Html::a('Home', ['/employer/index']) ?></li>
                                    <li><?= Html::a('Pricing', ['/employer/pricing']) ?></li>
                                    <li><?= Html::a('Blog', ['/employer/blog']) ?></li>
                                    <li><?= Html::a('Contact Us', ['/employer/contact']) ?></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-md-3 text-right who">
                        <?php //<?= Html::a('Employer', ['/employer/index'], ['class' => 'login active']) ?>
                        <?= Html::a('Jobseeker', ['/site/index'], ['class' => 'signup active']) ?>
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
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
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
                            <li><a href="#">Search CV's</a></li>
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
<!--                            <li><a href="#" title="Google"><span class="ti-google"></span></a></li>
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
