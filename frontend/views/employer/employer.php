<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\models\Industry;
use common\models\Skills;
use common\models\ExpectedSalary;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\widgets\Pjax;

$industry_datas = Industry::find()->where(['!=', 'id', 0])->andWhere(['status' => 1])->all();
$skills_datas = Skills::find()->where(['!=', 'industry', 0])->andWhere(['status' => 1])->all();
$city_datas = ArrayHelper::map(\common\models\City::find()->orderBy(['city' => SORT_ASC])->all(), 'id', function($model) {
            return common\models\Country::findOne($model['country'])->country_name . ' - ' . $model['city'];
        }
);
$latest_cvs = common\models\CandidateProfile::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
?>
<style>
    .select2-container-multi .select2-choices .select2-search-field input {
        height: 62px;
    }
</style>
<div class="site-banner right-img">
    <div class="banner-overlay" style="background: #1a72ba7d;"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="banner-content">
                    <h1>Search between more them <br> 50,000 open CV's.</h1>
                    <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.<br> Nam eget dui consequat vitae, eleifend ac etiam rhoncus</p>
                </div>
                <div class="job-search cv-search">
                    <?php $form = ActiveForm::begin(['action' => 'cv-search', 'id' => 'search_form', 'method' => 'post',]); ?>
                    <div class="form-group col-md-6 padding-left b-r radius">
                        <input type="text" class="form-control" placeholder="Job title / keywords" name="CvFilter[keyword]">
                        <div class="search_icon"><i class="fa fa-briefcase"></i></div>
                    </div>
                    <?= $form->field($model_filter, 'location')->dropDownList($city_datas, ['prompt' => '-Country / City-', 'multiple' => TRUE])->label(FALSE) ?>
                    <?php
//                    $form->field($model_filter, 'location')->widget(\yii\jui\AutoComplete::classname(), ['options' => ['class' => 'ui-autocomplete-input form-control'],
//                        'clientOptions' => [
//                            'source' => $this->context->getLocation(),
//                        ],
//                    ])->label(FALSE)
                    ?>
                    <!--                    <div class="form-group col-md-6 padding-left radius2">
                                            <input id="location" type="text" class="form-control" placeholder="Country / City" name="CvFilter[location]">
                                            <div class="search_icon"><i class="fa fa-map-marker"></i></span></div>
                                        </div>-->
                    <div class="btn-search">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-default']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            
            <div class="col-md-4" style="position: relative; float: right;">
                <div id="form" class="form-fixed">
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="<?= $flag == 1 ? 'active' : '' ?>"><a href="#login" role="tab" data-toggle="tab" aria-expanded="false">Log in</a></li>
                            <li class="<?= $flag == 0 ? 'active' : '' ?>"><a href="#signup" role="tab" data-toggle="tab" aria-expanded="true">Sign up</a></li>
                        </ul>
                        <div class="tab-content">
                            <?= \common\widgets\Alert::widget() ?>
                            <div class="tab-pane fade <?= $flag == 1 ? 'active in' : '' ?>" id="login">
                                <?php Pjax::begin() ?>
                                <?php $form1 = ActiveForm::begin(['id' => 'employer-login-form']); ?>
                                <?= $form1->field($model, 'email')->textInput()->label('Enter E-mail') ?>
                                <?= $form1->field($model, 'password')->passwordInput() ?>
                                <p class="error-block" style="<?= $stat == 1 ? 'display: block;' : 'display: none;' ?>"><a id="employer-resnd" class="resnd-btn">Resend Email Verification</a></p>
                                <div class="clearfis"></div>
                                <div class="text-left p-t-12">
                                    <span class="txt1">
                                        Forgot
                                    </span>
                                    <!--<li class="<?= $flag == 0 ? 'active' : '' ?>"><a href="#forgot-password" role="tab" data-toggle="tab" aria-expanded="true">forgot</a></li>-->
                                    <a href="#forgot-password" role="tab" data-toggle="tab" aria-expanded="true" class="txt2" href="#">
                                        Password?
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
                                <?php $form2 = ActiveForm::begin(['id' => 'employer-signup-form']); ?>
                                <?= $form2->field($model_register, 'first_name')->textInput() ?>
                                <?= $form2->field($model_register, 'last_name')->textInput() ?>
                                <?= $form2->field($model_register, 'email')->textInput() ?>
                                <?= $form2->field($model_register, 'password')->passwordInput() ?>
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
<main id="maincontent">
    <div class="container skill">
        <div class="row">
            <div class="col-md-9">
                <div class="page-heading">
                    <h2>Find CV's by Skill, Industry & Location</h2>
                    <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu.</p>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Industry">CV's By Industry</a></li>
                    <li><a data-toggle="tab" href="#Skills">CV's By Skills</a></li>
                    <li><a data-toggle="tab" href="#Location">CV's By Location</a></li>
                </ul>
                <div class="tab-content">
                    <div id="Industry" class="tab-pane fade in active">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($industry_datas as $industry_data) { ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $industry_data->industry_name ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="Skills" class="tab-pane fade">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($skills_datas as $skills_data) { ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $skills_data->skill ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="Location" class="tab-pane fade">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($city_datas as $city_data) {
                                    ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $city_data ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="Resume pad0">
                    <img class="img-responsive" src="images/home/2-sec-bg.jpg" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-heading">
                        <h2>Featured CV's</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-bg">
                        <table class="table">
                            <tbody>
                                <?php
                                if (!empty($latest_cvs)) {
                                    foreach ($latest_cvs as $latest_cv) {
                                        ?>
                                        <tr>
                                            <td style="width:40%;">
                                                <div class="tab-image">
                                                    <?php
                                                    if ($latest_cv->photo != '') {
                                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $latest_cv->id . '.' . $latest_cv->photo;
                                                        if (file_exists($dirPath)) {
                                                            echo '<img width="70px" height="" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $latest_cv->id . '.' . $latest_cv->photo . '" class="img-responsive"/>';
                                                        } else {
                                                            echo '<img width="70px" height="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg" class="img-responsive"/>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <h1><?= $latest_cv->title ?> <p><?= $latest_cv->name_view == 1 ? $latest_cv->name : '***********' ?></p></h1>
                                            </td>
                                            <td class="work-time" style="width:10%;"><?= $latest_cv->expected_salary == '' ? '' : ExpectedSalary::findOne($latest_cv->expected_salary)->salary_range ?></td>
                                            <td style="width:40%;">
                                                <?php
                                                if ($latest_cv->skill != '') {
                                                    $str_datas = explode(",", $latest_cv->skill);
                                                    $i = 0;
                                                    $strr = '';
                                                    foreach ($str_datas as $str_data) {
                                                        $i++;
                                                        $strr .= Skills::findOne($str_data)->skill;
                                                        $strr .= ', ';
                                                    }
                                                    echo $strr;
                                                } else {
                                                    echo '';
                                                }
                                                ?>
                                            </td>
                                            <td style="width:10%;">
                                                <?= Html::a('View CV', ['view-cv', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $latest_cv->id)], ['class' => 'table-btn-default']) ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="employe ptop60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Top Employes</h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe1.png" alt="" class="img-responsive"  /></a>
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
                        <h1>CV<span>s</span></h1>
                        <strong>success stories</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="testi-slider">
                        <ul class="slides list-inline">
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
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
                        <h2>We are Popular <span>Everywhere</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="vector_map">
                        <img src="images/home/map.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="jobxpress">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 padding-left">
                    <div class="left-col">
                        <div class="col-text">
                            <div class="page-heading heading4">
                                <h2>Join Thousands of Companies That Realy on <span>CVs Database</span></h2>
                                <hr>
                                <p>Sed consequat, leo eget bibendum sodales, augue cursus nunc, quis <br /> gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum <br />purus quam, scelerisque ut.</p>
                                <a href="#" class="btn Read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 padding-left">
                    <div class="right-col"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Latest News form <span>CVs Database</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block1">
                        <a href="#"><img src="images/home/blog1.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 padding-left text-right">
                                <h3>April 25, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies tellus eget condimentum nisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block1">
                        <a href="#"><img src="images/home/blog2.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 padding-left text-right">
                                <h3>March 13, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10">
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
    $(function () {
        $(".field-cvfilter-location").addClass("col-md-6 padding-left radius2");
    });
    $('#cvfilter-location').attr('placeholder', 'Country / Location');
</script>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#cvfilter-location").select2({
            placeholder: 'Choose Country / City',
            allowClear: true,
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

    });
</script>
<script>
    $(document).ready(function () {
       $(document).on("click", "#employer-resnd", function (e) {
            var email = $('#employer-email').val();
            if (validateEmail(email)) {
                $.ajax({
                    type: 'POST',
                    cache: false,
                    async: false,
                    data: {email: email},
                    url: '<?= Yii::$app->homeUrl ?>employer/resend-email-verification',
                    success: function (data) {
                        if (data == 1) {
                            $('##').css('display', 'none');
                            $('.field-employer-password .help-block-error').text('An email has been sent to your mail id (check your spam folder too)');
                        } else {
                            $('.field-employer-password .help-block-error').text('Invalid Employer.');
                            e.preventDefault();
                        }
                    }
                });
            } else {
                $('.field-employer-password .help-block-error').text('Enter a valid Email ID.');
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
                url: '<?= Yii::$app->homeUrl ?>employer/forgot',
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