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
$str = '';
$country_sort = common\models\Country::find()->orderBy(['country_name' => SORT_ASC])->all();
if (!empty($country_sort)) {
    foreach ($country_sort as $sort) {
        $str .= $sort->id . ',';
    }
}
if ($str != '') {
    $str = rtrim($str, ',');
}
$city_datas = ArrayHelper::map(\common\models\City::find()->orderBy([new \yii\db\Expression('FIELD (country, ' . $str . ')')])->all(), 'id', function($model) {
            return common\models\Country::findOne($model['country'])->country_name . ' - ' . $model['city'];
        }
);
$latest_cvs = common\models\CandidateProfile::find()->where(['status' => 1, 'featured_cv' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
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
                    <h1>The Fastest Way to Hire Talent</h1>
                    <p>Easily Search for C.Vs from great candidates based in the UAE and other Gulf countries</p>
                </div>
                <div class="job-search cv-search">
                    <?php $form = ActiveForm::begin(['action' => 'cv-search', 'id' => 'search_form', 'method' => 'post',]); ?>
                    <div class="form-group col-md-5 padding-left radius">
                        <input type="text" class="form-control" placeholder="Job title / keywords" name="CvFilter[keyword]">
                        <div class="search_icon"><i class="fa fa-briefcase"></i></div>
                    </div>
                    <?= $form->field($model_filter, 'location')->dropDownList($city_datas, ['multiple' => TRUE])->label(FALSE) ?>
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
                                <?php $form2 = ActiveForm::begin(['id' => 'employer-signup-form']); ?>
                                <?= $form2->field($model_register, 'first_name')->textInput() ?>
                                <?= $form2->field($model_register, 'email')->textInput() ?>
                                <?= $form2->field($model_register, 'password')->passwordInput() ?>
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
<main id="maincontent">
    <div class="container skill">
        <div class="row">
            <div class="col-md-9">
                <div class="page-heading">
                    <h2>Find Cvs by Skills, Industry  and Location</h2>
                    <p>Our comprehensive CVs database covers all functional areas and candidate skills that every company irrespective of size will be looking to recruit. Start your search today!</p>
                </div>

                <div class="cvs-sort-list">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pad0">
                        <div class="box">
                            <h5 class="heading">CVs by Industry</h5>
                            <ul>
                                <?php foreach ($industry_datas as $industry_data) { ?>
                                    <li>
                                        <a href="#"><?= $industry_data->industry_name ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pad0">
                        <div class="box">
                            <h5 class="heading">CVs by skills</h5>
                            <ul>
                                <?php foreach ($skills_datas as $skills_data) { ?>
                                    <li>
                                        <a href="#"><?= $skills_data->skill ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pad0">
                        <div class="box b0">
                            <h5 class="heading">CVs by location</h5>
                            <ul>
                                <?php foreach ($city_datas as $city_data) {
                                    ?>
                                    <li>
                                        <a href="#"> <?= $city_data ?></a>
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
                    <img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>images/Add-Section-1.jpg" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (!empty($latest_cvs)) {
        ?>
        <section class="featured">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-heading">
                            <h2>Featured CVs</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-bg">
                            <div class="table">
                                <?php foreach ($latest_cvs as $latest_cv) { ?>
                                    <?php
                                    $model_experiences = \common\models\WorkExperiance::find()->where(['candidate_id' => $latest_cv->id])->all();
                                    $tot_diff = 0;
                                    $month = 0;
                                    $year = 0;
                                    foreach ($model_experiences as $experiences) {
                                        $date1 = $experiences->from_date;
                                        if ($experiences->present_status == 1) {
                                            $date2 = date('Y-m-d');
                                        } else {
                                            $date2 = $experiences->to_date;
                                        }

                                        $ts1 = strtotime($date1);
                                        $ts2 = strtotime($date2);

                                        $year1 = date('Y', $ts1);
                                        $year2 = date('Y', $ts2);

                                        $month1 = date('m', $ts1);
                                        $month2 = date('m', $ts2);
                                        $tot_diff += (($year2 - $year1) * 12) + ($month2 - $month1);
                                    }
                                    if ($tot_diff > 0) {
                                        $month = $tot_diff % 12;
                                        $year = (int) ($tot_diff / 12);
                                    }
                                    ?>
                                    <div class="candidate-list">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 pl0">
                                            <div class="tab-image">
                                                <?php
                                                if ($latest_cv->photo != '') {
                                                    $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $latest_cv->id . '.' . $latest_cv->photo;
                                                    if (file_exists($dirPath)) {
                                                        echo '<img width="70px" height="" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $latest_cv->id . '.' . $latest_cv->photo . '" class="img-responsive"/>';
                                                    } else {
                                                        echo '<img width="70px" height="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg" class="img-responsive"/>';
                                                    }
                                                } else {
                                                    echo '<img width="70px" height="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg" class="img-responsive"/>';
                                                }
                                                ?>
                                            </div>
                                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 xlpl0">
                                                <h1><strong><?= $latest_cv->name_view == 1 ? '***********' : $latest_cv->name ?></strong> - <?= $latest_cv->title ?></h1>
                                                <div class="">
                                                    <div class="contact_details col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l">
                                                        <span><strong>Currently:</strong> <?= $latest_cv->current_country != '' ? common\models\Country::findOne($latest_cv->current_country)->country_name : '' ?> <?= $latest_cv->current_city != '' ? ', ' . common\models\City::findOne($latest_cv->current_city)->city : '' ?> </span>
                                                    </div>
                                                    <div class="contact_details col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l">
                                                        <span><strong>Exp:</strong><?= $year . ' Year ' . $month . ' Month' ?></span>
                                                    </div>
                                                    <div class="contact_details col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l">
                                                        <span><strong>Nationality:</strong> <?= $latest_cv->nationality != '' ? common\models\Country::findOne($latest_cv->nationality)->country_name : '' ?></span>
                                                    </div>
                                                    <div class="contact_details col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l">
                                                        <span><strong>Expected Salary($):</strong>  <?= $latest_cv->expected_salary == '' ? '' : ExpectedSalary::findOne($latest_cv->expected_salary)->salary_range ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl0">
                                                    <div class="contact_details p-l skills-sec">
                                                        <span><strong>Skills:</strong> 
                                                            <ul class="skills-list">
                                                                <?php
                                                                $skill_datas = explode(',', $latest_cv->skill);
                                                                if (!empty($skill_datas)) {
                                                                    foreach ($skill_datas as $skill_data) {
                                                                        $skill_row = common\models\Skills::find()->where(['id' => $skill_data, 'status' => 1])->one();
                                                                        if (!empty($skill_row)) {
                                                                            ?>
                                                                            <li><?= $skill_row->skill ?></li>
                                                                        <?php }
                                                                        ?>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 mob-pos pr0">
                                            <div class="action-box">
                                                <div class="contact_details col-md-12 col-sm-12 p-r refid">
                                                    <?php
                                                    $user_id = common\models\Candidate::findOne($latest_cv->candidate_id)->user_id;
                                                    ?>                                                    
                                                    <span><strong>cv # <?= $user_id ?></span>
                                                </div>
                                                <div class="contact_details col-md-12 col-sm-12 p-r action-btn">
                                                    <?php if (isset(Yii::$app->user->identity->id)) { ?>
                                                        <?= Html::a('View CV', ['view-cv', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $latest_cv->id)], ['class' => 'table-btn-default']) ?>
                                                    <?php } else { ?>
                                                        <?= Html::a('View CV', 'javascript:void(0)', ['class' => 'table-btn-default myBtn', 'id' => 'myBtn']) ?>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
    ?>
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
    <section class="jobxpress">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 padding-left">
                    <div class="left-col">
                        <div class="col-text">
                            <div class="page-heading heading4">
                                <h2>Joins hundreds of Companies that rely on <span>CVs Database</span></h2>
                                <hr>
                                <p>Some of the UAE and Gulf regions's leading companies rely on CVsDatabase to find great candidates. </p>
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
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog1.jpg" alt="" class="img-responsive"></a>
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
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog2.jpg" alt="" class="img-responsive"></a>
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
<div id="returnModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p><?= Html::a('<button type="button" class="btn btn-primary">Log in</button>', ['employer/index']) ?> to read the CV</p>
            </div>
        </div>

    </div>
</div>
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
<script>
    $('.myBtn').on('click', function () {
        $('#returnModal').modal('toggle');
    });
</script>