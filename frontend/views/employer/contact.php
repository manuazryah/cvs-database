<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="page_banner banner price-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  col-12">
                <div class="apus-breadscrumb">
                    <div class="wrapper-breads">
                        <div class="wrapper-breads-inner">
                            <h3 class="bread-title">Contact Us</h3>
                            <div class="breadscrumb-inner">
                                <ol class="breadcrumb">
                                    <li><?= Html::a('Home', ['/employer/index']) ?> </li>
                                    <li><span class="active">Contact Us</span></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent">
    <section class="contact-page">
        <div class="container">
            <div class="row">
                <div class="heading-center">
                    <h3 class="title">Our Helpline 24×7 Available</h3>
                    <div class="line-under"></div>
                    <div class="content">Call us at <strong class="text-second">+971 50 475 2515</strong><br>Email us at <strong class="text-theme">admin@cvsdatabase.com</strong></div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="column-inner">
                        <div class="wpb_wrapper">
                            <div role="" class="" id="" lang="en-US" dir="ltr">
                                <div class="screen-reader-response"></div>
                                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'class' => 'wpcf7-form']); ?>
                                <div class="widget widget-contact">
                                    <h3 class="widget-title">Leave A Message</h3>
                                    <div class="widget-content">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="author">
                                                    <span class="wpcf7-form-control-wrap your-name">
                                                        <?= $form->field($model, 'name')->textInput(['class' => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control', 'placeholder' => 'Name *'])->label(FALSE) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="email">
                                                    <span class="wpcf7-form-control-wrap your-email">
                                                        <?= $form->field($model, 'email')->textInput(['class' => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control', 'placeholder' => 'Email *'])->label(FALSE) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="subject">
                                            <span class="wpcf7-form-control-wrap your-subject">
                                                <?= $form->field($model, 'subject')->textInput(['class' => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control', 'placeholder' => 'Subject *'])->label(FALSE) ?>
                                            </span>
                                        </div>
                                        <p>
                                            <span class="wpcf7-form-control-wrap your-message">
                                                <?= $form->field($model, 'message')->textarea(['rows' => 10, 'class' => 'wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control']) ?>
                                            </span>
                                            <?= Html::submitButton('Submit', ['class' => 'wpcf7-form-control wpcf7-submit btn btn-second']) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="wpcf7-response-output wpcf7-display-none"></div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="column-inner">
                        <div class="wpb_wrapper">
                            <div class="vc_empty_space  hidden-sm hidden-xs"></div>
                            <div class="widget widget-contact-info ">
                                <h3 class="widget-title">
                                    <span>Contact Info</span>
                                </h3>
                                <div class="content">
                                    <div class="info">
                                        <div class="info-item">
                                            <div class="icon"> <i class="fa fa-map"></i> </div>
                                            <div class="des">Dubai, United Arab Emirates</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="icon"> <i class="fa fa-envelope"></i> </div>
                                            <div class="des">admin@cvsdatabase.com</div>
                                        </div>
                                        <div class="info-item">
                                            <div class="icon"> <i class="fa fa-phone"></i> </div>
                                            <div class="des">+971 50 475 2515</div>
                                        </div>
                                    </div>
                                    <div class="socials">
                                        <a class="icon" href="https://www.facebook.com/CVsDatabasecom-1617580895012671/ "> <i class="fa fa-facebook"></i> </a>
                                        <a class="icon" href="https://twitter.com/Cvs_Database "> <i class="fa fa-twitter"></i> </a>
                                        <a class="icon" href="https://www.linkedin.com/company/cvsdatabase/"> <i class="fa fa-linkedin"></i> </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>