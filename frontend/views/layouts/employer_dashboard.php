<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\EmployerAsset;
use yii\helpers\Html;

EmployerAsset::register($this);
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

        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
    </head>
    <body class="page-body">
        <?php $this->beginBody() ?>


        <div class="page-container">
            <div class="sidebar-menu toggle-others fixed/* collapsed*/">

                <div class="sidebar-menu-inner">
                    <header class="logo-env">
                        <!-- logo -->
                        <div class="logo">
                            <a href="" class="logo-expanded">
                                <img width="" height="" src="<?= Yii::$app->homeUrl ?>dash/images/site-logo.png"/>
                            </a>

                            <a href="" class="logo-collapsed">
                                <img width="59" height="43" src="<?= Yii::$app->homeUrl ?>dash/images/site-logo.png"/>
                            </a>
                        </div>
                        <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                        <div class="mobile-menu-toggle visible-xs">
                            <a href="" data-toggle="user-info-menu">
                                <i class="fa-bell-o"></i>
                                <span class="badge badge-success">7</span>
                            </a>

                            <a href="" data-toggle="mobile-menu">
                                <i class="fa-bars"></i>
                            </a>
                        </div>
                        <!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->



                    </header>
                    <ul id="main-menu" class="main-menu">
                        <li>
                            <?= Html::a('<i class="fa fa-search"></i> <span class="title">Search CV</span>', ['/employer/home'], ['class' => 'title']) ?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-edit"></i> <span class="title">Edit Profile</span>', ['/employer/update'], ['class' => 'title']) ?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-lock"></i> <span class="title">Change Password</span>', ['/employer/change-password'], ['class' => 'title']) ?>
                        </li>
                        <li>
                            <?= Html::a('<i class="fa fa-list"></i> <span class="title">Package Details</span>', ['/employer/user-plans'], ['class' => 'title']) ?>
                        </li>
                    </ul>
                </div>

            </div>

            <div class="main-content">

                <nav class="navbar user-info-navbar"  role="navigation"><!-- User Info, Notifications and Menu Bar -->

                    <!-- Left links for user info navbar -->
                    <ul class="user-info-menu left-links list-inline list-unstyled">

                        <li class="hidden-sm hidden-xs">
                            <a href="" data-toggle="sidebar">
                                <i class="fa-bars"></i>
                            </a>
                        </li>
                        <li class="dropdown hover-line hover-line-notify" style="min-height: 48px;">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
                                <i class="fa-bell-o"></i>
                                <!--<span class="badge badge-purple" id="notify-count"></span>-->
                                <span class="badge badge-purple" id="notify-count">0</span>
                            </a>
                            <ul class="dropdown-menu notifications">
                                <li class="top">
                                    <p class="small">
                                        <!--                                        <a href="#" class="pull-right">Mark all Read</a>-->
                                        You have <strong id="notify-counts">0</strong> new notifications.
                                    </p>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar ps-container">

                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
                                    </ul>
                                </li>

                                <li class="external">
                                    <?= Html::a('<span>View all notifications</span> <i class="fa-link-ext"></i>', ['/notification/cheque-notification']) ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- Right links for user info navbar -->
                    <ul class="user-info-menu right-links list-inline list-unstyled">

                        <li>
                            <a href="<?= Yii::$app->homeUrl; ?>employer/home"><i class="fa-home"></i> Home</a>
                        </li>

                        <li class="dropdown user-profile">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= yii::$app->homeUrl; ?>dash/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
                                <span>
                                    <?= Yii::$app->user->identity->first_name ?>
                                    <i class="fa-angle-down"></i>
                                </span>
                            </a>

                            <ul class="dropdown-menu user-profile-menu list-unstyled">
                                <li class="user-header">
                                    <img src="<?= yii::$app->homeUrl; ?>dash/images/user-4.png" alt="user-image" class="img-circle" />
                                    <p>
                                        <?= Yii::$app->user->identity->first_name ?>
                                        <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <li class="user-footer" style="background: #eeeeee;">
                                    <div class="row">
                                        <div class="pull-left">
                                            <?= Html::a('Profile', ['/employer/update'], ['class' => 'btn btn-white', 'style' => 'padding: 9px 20px;border: 1px solid #a09f9f;']) ?>
                                        </div>
                                        <div class="pull-right">
                                            <?php
                                            echo ''
                                            . Html::beginForm(['/employer/logout'], 'post', ['style' => 'margin-bottom: 0px;']) . '<a>'
                                            . Html::submitButton(
                                                    'Sign out', ['class' => 'btn btn-white', 'style' => 'border: 1px solid #a09f9f;']
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

                </nav>
                <div class="row">


                    <?= $content; ?>


                </div>
                <footer class="main-footer sticky footer-type-1">

                    <div class="footer-inner">

                        <!-- Add your copyright text here -->
                        <div class="footer-text">
                            &copy; <?= Html::encode(date('Y')) ?>
                            <strong>Azryah</strong>
                            All rights reserved.
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
        <!-- Page Loading Overlay -->
        <div class="page-loading-overlay">
            <div class="loader-2"></div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>