<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\EmployerAsset;
use yii\helpers\Html;

EmployerAsset::register($this);
$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
?>
<?php $this->beginPage() ?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--<link rel="shortcut icon" href="<?= yii::$app->homeUrl; ?>images/fav.png" type="image/png" />-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Xenon Boostrap Admin Panel" />
        <meta name="author" content="" />
        <title>Employer Dashboard</title>
        <script src="<?= Yii::$app->homeUrl; ?>dash/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            var homeUrl = '<?= Yii::$app->homeUrl; ?>';
        </script>
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
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body class="page-body">
        <?php $this->beginBody() ?>

        <nav class="navbar horizontal-menu navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->

            <div class="navbar-inner">

                <!-- Navbar Brand -->
                <div class="navbar-brand">
                    <a href="" class="logo">
                        <img src="<?= Yii::$app->homeUrl ?>dash/images/site-logo.png" width="200" alt="" class="hidden-xs" />
                        <img src="<?= Yii::$app->homeUrl ?>dash/images/site-logo.png" width="150" alt="" class="visible-xs" />
                    </a>
                </div>

                <!-- Mobile Toggles Links -->
                <div class="nav navbar-mobile">
                    
                    <div class="pull-right">
                        <?php
                        echo ''
                        . Html::beginForm(['/employer/logout'], 'post', ['style' => 'margin-bottom: 0px; padding: 0px;']) . '<a style="padding-bottom:0px;">'
                        . Html::submitButton(
                                '<i class="fa fa-sign-out"></i> Sign out', ['class' => 'btn btn-white sign-out',]
                        ) . '</a>'
                        . Html::endForm()
                        . '';
                        ?>
                    </div>
                    
                    <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                    <div class="mobile-menu-toggle">
                        <a href="#" data-toggle="mobile-menu-horizontal">
                            <i class="fa-bars"></i>
                        </a>
                    </div>

                </div>

                <div class="navbar-mobile-clear"></div>

                <ul class="navbar-nav">
                    <li class="<?= $action == 'employer/home' ? 'active' : '' ?>">
                        <?= Html::a('<i class="fa fa-search"></i> <span class="title">Search CV</span>', ['/employer/home'], ['class' => 'title']) ?>
                    </li>
                    <li class="<?= $action == 'employer/view' ? 'active' : '' ?>">
                        <?= Html::a('<i class="fa fa-eye"></i> <span class="title">Your Profile </span>', ['/employer/view'], ['class' => 'title']) ?>
                    </li>
                    <li class="<?= $action == 'employer/change-password' ? 'active' : '' ?>">
                        <?= Html::a('<i class="fa fa-lock"></i> <span class="title">Change Password</span>', ['/employer/change-password'], ['class' => 'title']) ?>
                    </li>
                    <li class="<?= $action == 'employer/user-plans' || $action == 'employer/upgrade-package' ? 'active' : '' ?>">
                        <?= Html::a('<i class="fa fa-list"></i> <span class="title">Package Details</span>', ['/employer/user-plans'], ['class' => 'title']) ?>
                    </li>
                    <li class="<?= $action == 'employer/shortlist-folder' ? 'active' : '' ?>">
                        <?= Html::a('<i class="fa fa-folder-open"></i> <span class="title">Shortlist Folder</span>', ['/employer/shortlist-folder'], ['class' => 'title']) ?>
                    </li>
                </ul>

                <!-- notifications and other links -->
                <ul class="nav nav-userinfo navbar-right">
                    <li>
                        <a href="tel:+971 50 4752515"><strong style="margin-right: 10px;">Support: </strong> +971 50 4752515</a>
                    </li>
                    <li><a href="mailto:info@cvs.ae"> admin@CVsDatabase.com</a></li>
                    <li>
                        <a href="<?= Yii::$app->homeUrl; ?>employer/home"><i class="fa-home"></i> Home</a>
                    </li>

                    <li class="dropdown user-profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!--<img src="<?= yii::$app->homeUrl; ?>dash/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />-->
                            <span>
                                <?= Yii::$app->session['employer_data']['first_name'] ?>
                                <i class="fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="dropdown-menu user-profile-menu list-unstyled">
                            <!--                            <li class="user-header">
                                                            <img src="<?= yii::$app->homeUrl; ?>dash/images/user-4.png" alt="user-image" class="img-circle" />
                                                            <p>
                            <?= Yii::$app->session['employer_data']['first_name'] ?>
                                                                <small>Member since Nov. 2012</small>
                                                            </p>
                                                        </li>-->
                            <li class="user-footer" style="background: #0474ba;">
                                <div class="row">
                                    <div class="pull-left">
                                        <?= Html::a('Profile', ['/employer/update'], ['class' => 'btn btn-white signin',]) ?>
                                    </div>
                                    <div class="pull-right">
                                        <?php
                                        echo ''
                                        . Html::beginForm(['/employer/logout'], 'post', ['style' => 'margin-bottom: 0px; padding: 0px;']) . '<a style="padding-bottom:0px;">'
                                        . Html::submitButton(
                                                'Sign out', ['class' => 'btn btn-white sign-out',]
                                        ) . '</a>'
                                        . Html::endForm()
                                        . '';
                                        ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>

        </nav>

        <div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

            <div class="sidebar-menu toggle-others fixed">
                <div class="sidebar-menu-inner">

                    <ul id="main-menu" class="main-menu">
                        <li class="<?= $action == 'employer/home' ? 'active' : '' ?>">
                            <?= Html::a('<i class="fa fa-search"></i> <span class="title">Search CV</span>', ['/employer/home'], ['class' => 'title']) ?>
                        </li>
                        <li class="<?= $action == 'employer/view' ? 'active' : '' ?>">
                            <?= Html::a('<i class="fa fa-eye"></i> <span class="title">Your Profile </span>', ['/employer/view'], ['class' => 'title']) ?>
                        </li>
                        <li class="<?= $action == 'employer/change-password' ? 'active' : '' ?>">
                            <?= Html::a('<i class="fa fa-lock"></i> <span class="title">Change Password</span>', ['/employer/change-password'], ['class' => 'title']) ?>
                        </li>
                        <li class="<?= $action == 'employer/user-plans' || $action == 'employer/upgrade-package' ? 'active' : '' ?>">
                            <?= Html::a('<i class="fa fa-list"></i> <span class="title">Package Details</span>', ['/employer/user-plans'], ['class' => 'title']) ?>
                        </li>
                        <li class="<?= $action == 'employer/shortlist-folder' ? 'active' : '' ?>">
                            <?= Html::a('<i class="fa fa-folder-open"></i> <span class="title">Shortlist Folder</span>', ['/employer/shortlist-folder'], ['class' => 'title']) ?>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="main-content">
                <?= $content; ?>
                <div class="clearfix"></div>
                <footer class="main-footer sticky footer-type-1">

                    <div class="footer-inner">

                        <!-- Add your copyright text here -->
                        <div class="footer-text">
                            <strong>© 2018 CVs Database. All rights reserved.</strong>
                        </div>


                        <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                        <div class="go-up">

                            <a href="#" rel="go-top">
                                <i class="fa-angle-up"></i>
                            </a>

                        </div>

                    </div>

                </footer>
            </div>
        </div>

        <div class="page-loading-overlay">
            <div class="loader-2"></div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
<script type="text/javascript">
    $(document).ready(function () {
    });
</script>