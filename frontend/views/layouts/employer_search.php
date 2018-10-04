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
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="header-stricky">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="site-logo">
                            <?= Html::a('<img src="' . Yii::$app->homeUrl . 'images/home/site-logo.png" alt="" class="img-responsive" />', ['/employer/index']) ?>
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
        <div class="container">
            <?= $content ?>
        </div>
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
                            <li><?= Html::a('Contact us', ['/employer/contact']) ?></li>
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
                            <li><a href="https://www.facebook.com/CVsDatabasecom-1617580895012671/ " title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.linkedin.com/company/cvsdatabase/" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://twitter.com/Cvs_Database " title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
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

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
