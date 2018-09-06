<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="site-banner">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="banner-content">
                    <h1>The eazy way to <br>Get hired</h1>
                    <p><mark>Submit your C.V and get selected by top recruiters <br>in the UAE and other Gulf countries</mark></p>
                </div>
            </div>
            <div class="col-md-4 signup-box">
                <div id="form" class="form-fixed">
                    <h3>submit your <strong>CV</strong> now</h3>
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="<?= $flag == 1 ? 'active' : '' ?>"><a href="#login" role="tab" data-toggle="tab" aria-expanded="false">Log in</a></li>
                            <li class="<?= $flag == 0 ? 'active' : '' ?>"><a href="#signup" role="tab" data-toggle="tab" aria-expanded="true">Sign up</a></li>
                        </ul>
                        <div class="tab-content">
                            <?= \common\widgets\Alert::widget() ?>
                            <div class="tab-pane fade <?= $flag == 1 ? 'active in' : '' ?>" id="login">
                                <?php Pjax::begin() ?>
                                <?php $form1 = ActiveForm::begin(['id' => 'candidate-login-form']); ?>
                                <?= $form1->field($model, 'user_name')->textInput()->label('Enter E-mail') ?>
                                <?= $form1->field($model, 'password')->passwordInput() ?>
                                <p class="error-block" style="<?= $stat == 1 ? 'display: block;' : 'display: none;' ?>"><a id="candidate-resnd" class="resnd-btn">Resend Email Verification</a></p>
                                <div class="clearfis"></div>
                                <div class="text-left p-t-12">
                                    <!--<li class="<?= $flag == 0 ? 'active' : '' ?>"><a href="#forgot-password" role="tab" data-toggle="tab" aria-expanded="true">forgot</a></li>-->
                                    <a href="#forgot-password" role="tab" data-toggle="tab" aria-expanded="true" class="txt2" href="#">
                                        <span class="txt1">Forgot Password?</span>
                                    </a>
                                </div>
                                <div>
                                    <?= Html::submitButton('Log In', ['class' => 'btn btn-larger btn-block', 'name' => 'candidate-login-button']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php Pjax::end() ?>
                            </div>
                            <div class="tab-pane fade <?= $flag == 0 ? 'active in' : '' ?>" id="signup">
                                <?php Pjax::begin() ?>
                                <?php $form = ActiveForm::begin(['id' => 'candidate-signup-form']); ?>
                                <?= $form->field($model_register, 'user_name')->textInput() ?>
                                <?= $form->field($model_register, 'email')->textInput() ?>
                                <?= $form->field($model_register, 'password')->passwordInput() ?>
                                <?= $form->field($model_register, 'password_repeat')->passwordInput() ?>
                                <div>
                                    <?= Html::submitButton('Sign up', ['class' => 'btn btn-larger btn-block', 'name' => 'candidate-signup-button']) ?>
                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php Pjax::end() ?>
                            </div>
                            <div class="tab-pane fade" id="forgot-password">
                                <form id="forgot-pass-form">
                                    <label class="control-label" for="forgot-password-email">Email</label>
                                    <input type="text" id="ForgotPassword-email" class="form-control" name="forgot-password" aria-required="true" aria-invalid="true">
                                    <div class="clear-fix"></div>
                                    <button type="submit" class="btn btn-larger btn-block" name="forgot-password-button">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<main id="maincontent" class="ptop0">
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Save time on your job search</h2>
                        <p>CVs Database os trusted by thousands of companies of all sizes an industries to hire talent in the shortest time possible. Ther's no need to look anywhere else. CVs Database is the only website you'll ever need to find your next job...</p>
                        <!--<a href="#" class="btn btn-default">Read More</a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="employe">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Trusted by Recruiters</h2>
                        <p>Some of the companies that CV's Database has helped find great talent</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="success_story">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-right">
                    <div class="page-heading2">
                        <h1>Job <span>Seekers</span></h1>
                        <strong><mark class="blue">success stories</mark></strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="testi-slider">
                        <ul class="slides list-inline">
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="<?= yii::$app->homeUrl; ?>images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>I was able to get a job just a few days from  when i arrived in Dubai. I couldn't imagine how soon i was able to start working and i love my job. Thank you CVs Database</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="<?= yii::$app->homeUrl; ?>images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>I was able to get a job just a few days from  when i arrived in Dubai. I couldn't imagine how soon i was able to start working and i love my job. Thank you CVs Database</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="<?= yii::$app->homeUrl; ?>images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>I was able to get a job just a few days from  when i arrived in Dubai. I couldn't imagine how soon i was able to start working and i love my job. Thank you CVs Database</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="visitor">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading heading3">
                        <h2>Covering the<br><span>UAE and the Gulf region</span></h2>
                        <p>We work with recruiters in the UAE and other Gulf Cuntries to fulfill their urgent recruitment needs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="vector_map">
                        <img src="<?= yii::$app->homeUrl; ?>images/home/map.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Latest News form <span>Jobseekers</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="block1">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog1.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 col-xs-2 padding-left text-right">
                                <h3>April 25, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies tellus eget condimentum nisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="block1">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog2.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 col-xs-2 padding-left text-right">
                                <h3>March 13, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies tellus eget condimentum nisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    $(document).ready(function () {
        $(document).on("blur", "#candidate-password", function () {
            validatePassword();
        });
        $(document).on("blur", "#candidate-confirm_password", function () {
            validatePassword();
        });
        function validatePassword() {
            var password = $('#candidate-password').val().trim();
            var confirm_password = $('#candidate-confirm_password').val().trim();
            if (password != '' && confirm_password != '') {
                $("#dailyentrydetails-total").val(rate * unit);
            }
        }

        $(document).on("click", "#candidate-resnd", function (e) {
            var email = $('#candidate-user_name').val();
            if (validateEmail(email)) {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    async: false,
                    data: {email: email},
                    url: '<?= Yii::$app->homeUrl ?>site/resend-email-varification',
                    success: function (data) {
                        if (data == 1) {
                            $('#candidate-resnd').css('display', 'none');
                            $('.field-candidate-password .help-block-error').text('An email has been sent to your mail id (check your spam folder too)');
                        } else {
                            $('.field-candidate-password .help-block-error').text('Invalid User.');
                            e.preventDefault();
                        }
                    }
                });
            } else {
                $('.field-candidate-password .help-block-error').text('Enter a valid Email ID.');
                e.preventDefault();
            }
        });

        $(document).on('submit', '#forgot-pass-form', function (e) {
            e.preventDefault();
            var email = $('#ForgotPassword-email').val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {email: email},
                url: '<?= Yii::$app->homeUrl ?>site/forgot',
                success: function (data) {
                    if (data == 1) {
                        $('#ForgotPassword-email').val('');
                        $("#ForgotPassword-email").next(".invoice-validation").remove();
                        $("#ForgotPassword-email").after("<div class='invoice-validation' style='color:red;margin-bottom: 20px;'>Password reset link has to send to your email.</div>");
                    } else {
                        $("#ForgotPassword-email").next(".invoice-validation").remove();
                        $("#ForgotPassword-email").after("<div class='invoice-validation' style='color:red;margin-bottom: 20px;'>Invalid Email ID</div>");
                    }
                }
            });
        });

    });
    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        } else {
            return false;
        }
    }
</script>
