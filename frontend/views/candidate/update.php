<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\components\ModalViewWidget;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$course_datas = common\models\Courses::find()->where(['status' => 1])->all();
$country_datas = common\models\Country::find()->where(['status' => 1])->all();
$city_datas = [];
if ($model->current_country != '') {
    $city_datas = ArrayHelper::map(\common\models\City::find()->where(['country' => $model->current_country])->all(), 'id', 'city');
}
?>

<style>
    .marg-bot-0 .form-group{
        margin-bottom: 0px;
    }
    .candidate_prof_add{
        background: white;
        padding: 0px;
        float: right;
        border-color: white;
        color: #067db1;
        font-weight: 500;
    }
    .candidate_prof_add:hover{
        color: #067db1;
    }
</style>
<main id="maincontent" class="my-account">
<!--    <section id="jobseeker-breadscrumb" class="breadcrumb-page jobseeker-breadscrumb has_img" style="background-image:url('<?= Yii::$app->homeUrl ?>images/bg-jobs.jpg')">
        <div class="container">
            <div class="wrapper-breads">
                <div class="wrapper-breads-inner">
                    <h3 class="bread-title">My Account</h3>
                    <div class="breadscrumb-inner">
                        <ol class="breadcrumb">
                            <li><a href="https://demojobseeker.com/entaro">Home</a> </li>
                            <li><span class="active">Edit Profile</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-lg-12">
                    <aside  id="target" class="aside">
                        <h4 class="title">My Account</h4>
                        <ul>
                            <li><?= Html::a('User Details', ['/candidate/index']) ?></li>
                            <li class="active"><?= Html::a('Profile Edit', ['/candidate/update-profile']) ?></li>
                            <li><?= Html::a('Online CV', ['/candidate/online-curriculum-vitae']) ?></li>
                            <li><?= Html::a('Reset Password', ['/candidate/reset-password']) ?></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-lg-12">
                    <div class="rightside-box mt95">
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                echo ModalViewWidget::widget();
                                ?>
                                <?php
                                $form = ActiveForm::begin([
                                            'options' => [
                                                'class' => 'panel-body register-form'
                                            ]
                                ]);
                                ?>
                                <div class="userccount">
                                    <div class="formpanel"> 
                                        <div class="delete-account">
                                            <?=
                                            Html::a('', ['delete-profile'], ['class' => ' prof-del delete-profile', 'title' => [
                                                    'Delete Profile',
                                                ], 'data' => [
                                                    'confirm' => 'Are you sure you want to delete your profile?',
                                                ],
                                            ])
                                            ?>
                                        </div>
                                        <!-- Personal Information -->
                                        <div class="form-group col-md-12 p-r  pad0">
                                            <div class="col-lg-12 pad0">
                                                <div class="profile">
                                                    <div class="profile-image">
                                                        <?php
                                                        if ($model->photo != '') {
                                                            $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                                            if (file_exists($dirPath)) {
                                                                echo '<img class="img-responsive" style="" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                            } else {
                                                                echo '<img class="img-responsive" style="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                                            }
                                                        }
                                                        if ($model->photo != '') {
                                                            $label = '<i class="fa fa-camera"></i> Update Profile Picture';
                                                        } else {
                                                            $label = 'Photo';
                                                        }
                                                        ?>
                                                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true])->label($label) ?>
                                                    </div>
                                                    <div class="profile-header">
                                                        <h3 class="main-heading"><?= $user->user_name ?></h3>
                                                        <h6 class="sub-heading"><?= $model->title != '' ? $model->title : '' ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <br>
                                        <div class="mb80"></div>
                                        <div class="">
                                            <div class="form-group col-md-12 p-l p-r">
                                                <div class="form-group col-md-6 p-l">
                                                    <div class="form-group field-candidateprofile-name required">
                                                        <label class="control-label" for="candidateprofile-name">Name</label>
                                                        <input type="text" id="candidateprofile-name" class="form-control" name="CandidateProfile[name]" value="manu" readonly="" aria-required="true">
                                                        <input type="hidden" name="CandidateProfile[name_view]" value="0"><label class="hide-view"><input type="checkbox" id="candidateprofile-name_view" name="CandidateProfile[name_view]" value="1" aria-invalid="false"> Hide Name In Public</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 p-r">
                                                    <?= $form->field($model, 'title')->textInput() ?>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 p-l">
                                                <?php $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name'); ?>
                                                <?= $form->field($model, 'nationality')->dropDownList($countries, ['prompt' => '-Choose a Nationality-']) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-r">
                                                <?= $form->field($model, 'current_country')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-l">
                                                <?= $form->field($model, 'current_city')->dropDownList($city_datas, ['prompt' => '-Choose a City-']) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-r">
                                                <?php $gender = ArrayHelper::map(\common\models\Gender::findAll(['status' => 1]), 'id', 'gender'); ?>
                                                <?= $form->field($model, 'gender')->dropDownList($gender) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-l">
                                                <?php
                                                if (!isset($model->dob) && $model->dob != '') {
                                                    $model->dob = date('d-M-Y');
                                                } else {
                                                    $model->dob = date("d-m-Y", strtotime($model->dob));
                                                }
                                                ?>
                                                <?=
                                                $form->field($model, 'dob')->widget(DatePicker::classname(), [
                                                    'type' => DatePicker::TYPE_INPUT,
                                                    'pluginOptions' => [
                                                        'autoclose' => true,
                                                        'format' => 'dd-M-yyyy'
                                                    ]
                                                ])->label('DOB');
                                                ?>
                                            </div>
                                            <div class="form-group col-md-6 p-r">
                                                <?php $salaty_ranges = ArrayHelper::map(common\models\ExpectedSalary::findAll(['status' => 1]), 'id', 'salary_range'); ?>
                                                <?= $form->field($model, 'expected_salary')->dropDownList($salaty_ranges, ['prompt' => '-Choose expected salary-']) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-l">
                                                <?php $job_types = ArrayHelper::map(\common\models\JobType::findAll(['status' => 1]), 'id', 'job_type'); ?>
                                                <?= $form->field($model, 'job_type')->dropDownList($job_types) ?>
                                            </div>
                                            <div class="form-group col-md-6 p-r">
                                                <?php $jobstatus = ArrayHelper::map(common\models\JobStatus::findAll(['status' => 1]), 'id', 'job_status'); ?>
                                                <?= $form->field($model, 'job_status')->dropDownList($jobstatus, ['prompt' => '-Choose a Job Status-']) ?>
                                            </div>
                                            <div class="form-group col-md-12 p-l p-r">
                                                <?=
                                                $form->field($model, 'executive_summary')->widget(CKEditor::className(), [
                                                    'options' => ['rows' => 3],
                                                    'preset' => 'basic'
                                                ])
                                                ?>
                                                <?php // $form->field($model, 'executive_summary')->textarea(['rows' => 3])    ?>
                                            </div>
                                        </div>
                                        <hr>

                                        <!-- Industries -->
                                        <div class="form-group col-md-12 p-l p-r marg-bot-0">
                                            <?php
                                            $skills = [];
                                            if (isset($model->industry) && $model->industry != '') {
                                                $model->industry = explode(',', $model->industry);
                                                $skills = ArrayHelper::map(\common\models\Skills::find()->where(['in', 'industry', $model->industry])->all(), 'id', 'skill');
                                            }
                                            ?>
                                            <?php $industries = ArrayHelper::map(\common\models\Industry::find()->where(['status' => 1])->andWhere(['>', 'id', 0])->all(), 'id', 'industry_name'); ?>
                                            <?= $form->field($model, 'industry')->dropDownList($industries, ['prompt' => 'Choose Industry', 'multiple' => 'multiple'])->label('<h5 class="section-title">Industries</h5>') ?>
                                            <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-industry'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                                        </div>

                                        <div class="form-group col-md-12 p-l p-r marg-bot-0">
                                            <?php
                                            if (isset($model->skill) && $model->skill != '') {
                                                $model->skill = explode(',', $model->skill);
                                            }
                                            ?>
                                            <?= $form->field($model, 'skill')->dropDownList($skills, ['prompt' => 'Choose Skills', 'multiple' => 'multiple'])->label('<h5 class="section-title">Skills</h5>') ?>
                                            <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-skill'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                                        </div>
                                        <div class="clearfix"></div>

                                        <!-- Experience -->
                                        <h5>Experience</h5>
                                        <div class="append-box">
                                            <a href=""><button class="remove"><i class="fa fa-close"></i></button></a>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="company" class="form-control" placeholder="Company">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="drsignation" class="form-control" placeholder="Designation">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="join-frm">
                                                            <option>Join From</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>2016</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="endon">
                                                            <option>End on</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>Present</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="country" class="form-control" placeholder="Country">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="formrow">
                                                        <textarea class="form-control" name="about-company" placeholder="About Company"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="append-box">
                                            <a href=""><button class="remove"><i class="fa fa-close"></i></button></a>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="company" class="form-control" placeholder="Company">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="drsignation" class="form-control" placeholder="Designation">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="join-frm">
                                                            <option>Join From</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>2016</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="endon">
                                                            <option>End on</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>Present</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="country" class="form-control" placeholder="Country">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="formrow">
                                                        <textarea class="form-control" name="about-company" placeholder="About Company"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                                            <a id="addexperience" class="btn btn-icon btn-blue addScnt btn-larger btn-block" ><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <br/>

                                        <!-- Education -->
                                        <h5>Education</h5>
                                        <div class="append-box">
                                            <a href=""><button class="remove"><i class="fa fa-close"></i></button></a>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="course" class="form-control" placeholder="Course Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="university" class="form-control" placeholder="College / University">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="join-frm">
                                                            <option>Join From</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>2016</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="endon">
                                                            <option>End on</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>Present</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="country" class="form-control" placeholder="Country">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="formrow">
                                                        <textarea class="form-control" name="about-company" placeholder="About Company"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="speration"></div>

                                        <div class="append-box">
                                            <a href=""><button class="remove"><i class="fa fa-close"></i></button></a>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="course" class="form-control" placeholder="Course Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="university" class="form-control" placeholder="College / University">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="join-frm">
                                                            <option>Join From</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>2016</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="formrow">
                                                        <select class="form-control" name="endon">
                                                            <option>End on</option>
                                                            <option>2011</option>
                                                            <option>2012</option>
                                                            <option>2013</option>
                                                            <option>2014</option>
                                                            <option>2015</option>
                                                            <option>Present</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="formrow">
                                                        <input type="text" name="country" class="form-control" placeholder="Country">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="formrow">
                                                        <textarea class="form-control" name="about-company" placeholder="About Company"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                                            <a id="addexperience" class="btn btn-icon btn-blue addScnt btn-larger btn-block" ><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <br/>
                                        <div class="form-group col-md-12 p-l p-r">
                                            <?= $form->field($model, 'hobbies')->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="form-group col-md-12 p-l p-r">
                                            <?= $form->field($model, 'extra_curricular_activities')->textarea(['rows' => 3]) ?>
                                        </div>
                                        <div class="form-group col-md-6 p-l">
                                            <?php $languages = ArrayHelper::map(\common\models\Languages::findAll(['status' => 1]), 'id', 'language'); ?>
                                            <?php
                                            if (isset($model->languages_known) && $model->languages_known != '') {
                                                $model->languages_known = explode(',', $model->languages_known);
                                            }
                                            ?>
                                            <?= $form->field($model, 'languages_known')->dropDownList($languages, ['prompt' => '-Choose a Language-', 'multiple' => 'multiple']) ?>
                                        </div>
                                        <div class="form-group col-md-6 p-r">
                                            <?php
                                            if (isset($model->driving_licences) && $model->driving_licences != '') {
                                                $model->driving_licences = explode(',', $model->driving_licences);
                                            }
                                            ?>
                                            <?= $form->field($model, 'driving_licences')->dropDownList($countries, ['multiple' => 'multiple']) ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12 p-l p-r">
                                            <div class="formrow">
                                                <?php
                                                if ($model->upload_resume != '') {
                                                    $label = 'Change Your CV';
                                                } else {
                                                    $label = 'Upload Your CV';
                                                }
                                                ?>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6 p-l">
                                                    <div class="form-control">
                                                        <?= $form->field($model, 'upload_resume')->fileInput(['maxlength' => true])->label($label) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                    if ($model->upload_resume != '') {
                                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                                        if (file_exists($dirPath)) {
                                                            echo '<a class="" href="' . Yii::$app->homeUrl . 'uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume . '" target="_blank"><span><i class="fa fa-file-pdf-o"></i> Download CV</span></a>';
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 p-r">
                                            <?php
//                        if ($model->upload_resume != '') {
//                            $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
//                            if (file_exists($dirPath)) {
//
                                            ?>
                                            <!--<a class="" href="//<?php // Yii::$app->homeUrl                                                                                                                     ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" target="_blank"><span>View Uploded CV</span></a>-->
                                            <?php
//                            }
//                        }
                                            ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <?= Html::submitButton('Submit', ['class' => 'btn btn-larger btn-block submit']) ?>
                                        <?php ActiveForm::end(); ?>

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
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#candidateprofile-industry").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#candidateprofile-skill").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
        $("#candidateprofile-driving_licences").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#candidateprofile-languages_known").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $(document).on('change', '#candidateprofile-industry', function () {
            var industry = $(this).val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {industry: industry},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-skills',
                success: function (data) {
                    $('#candidateprofile-skill').html(data);
                }
            });
        });
        $(document).on('change', '#candidateprofile-current_country', function () {
            var country = $(this).val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {country: country},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-city',
                success: function (data) {
                    $('#candidateprofile-current_city').html(data);
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        var counter = 0;

        $("#addeducation").on("click", function () {

            var counter = $('#myTable tr').length - 2;

            $("#ibtnDel").on("click", function () {
                counter = -1
            });
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-acadamics',
                success: function (data) {
                    $("table.order-list").append(data);
                }
            });
            counter++;
        });

        $("table.order-list").on("click", "#ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });

        $(document).on('click', '.eduremove', function () {
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-acadamics',
                success: function (data) {
                    if (data == 1) {
                        $('#edurow-' + current_row_id).remove();
                    }
                }
            });
        });


    });
</script>
<script>
    $(document).ready(function () {
        var counter = 0;

        $("#addexperience").on("click", function () {
            var counter = $('#experienceTable tr').length - 2;

            $("#ibtnDele").on("click", function () {
                counter = -1
            });
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-experience',
                success: function (data) {
                    $("table.experience-list").append(data);
                    $('.txtEditor').ckeditor();
                }
            });
            counter++;
        });

        $("table.experience-list").on("click", "#ibtnDele", function (event) {
            $(this).closest("tr").remove();
        });

        $(document).on('click', '.expremove', function () {
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-experience',
                success: function (data) {
                    if (data == 1) {
                        $('#exprow-' + current_row_id).remove();
                    }
                }
            });
        });
        $(document).on('click', '.modalButton', function () {

            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr("value"));
        });

    });
</script>
