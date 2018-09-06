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
$country_datas = common\models\Country::find()->where(['status' => 1])->orderBy(['country_name' => SORT_ASC])->all();
$city_datas = [];
if ($model->current_country != '') {
    $city_datas = ArrayHelper::map(\common\models\City::find()->where(['country' => $model->current_country])->all(), 'id', 'city');
}
$previous_date = date('Y-m-d', strtotime('-1 day'));
$current_date = date('Y-m-d');
if (!empty($model)) {
    $candidate_id = $model->id;
} else {
    $candidate_id = '';
}
?>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
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
                <div class="col-lg-2 col-md-3 col-sm-3 col-lg-12">
                    <aside  id="target" class="aside">
                        <h4 class="title">My Account</h4>
                        <ul>
                            <li><?= Html::a('User Details', ['/candidate/index']) ?></li>
                            <li class="active"><?= Html::a('Profile Edit', ['/candidate/update-profile']) ?></li>
                            <li><?= Html::a('CV View', ['/candidate/online-curriculum-vitae']) ?></li>
                            <li><?= Html::a('Reset Password', ['/candidate/reset-password']) ?></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-lg-12">
                    <div class="rightside-box">
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
                                <div class="update_alert"><?= \common\widgets\Alert::widget() ?></div>
                                <div class="userccount">
                                    <div class="formpanel">
                                        <div class="delete-account">
                                            <?=
                                            Html::a('', ['delete-profile'], ['class' => 'prof-del delete-profile', 'title' => [
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
                                                                echo '<img class="img-responsive" id="profle_img_" style="" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                            } else {
                                                                echo '<img class="img-responsive" id="profle_img_temp" style="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                                            }
                                                        } else {
                                                            echo '<img class="img-responsive" id="profle_img_temp"  style="" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                                        }
                                                        if ($model->photo != '') {
                                                            $label = '<i class="fa fa-camera"></i> Update Profile Picture';
                                                        } else {
                                                            $label = 'Photo';
                                                        }
                                                        ?>
                                                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true])->label($label) ?>
                                                        <span class = "required-size">Image dimension 200W ☓ 200H</span>
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
                                        <div class=" hidden-md hidden-sm hidden-xs"></div>
                                        <div class="">
                                            <div class="form-group col-md-12 p-l p-r">
                                                <div class="form-group col-md-6 p-l">
                                                    <div class="form-group field-candidateprofile-name required">
                                                        <label class="control-label" for="candidateprofile-name">Name</label>
                                                        <input type="text" id="candidateprofile-name" class="form-control" name="CandidateProfile[name]" value="<?= $user->user_name != '' ? $user->user_name : '' ?>" readonly="" aria-required="true">
                                                        <input type="hidden" name="CandidateProfile[name_view]" value="0"><label class="hide-view"><input type="checkbox" <?= $model->name_view == '1' ? 'checked="checked"' : '' ?> id="candidateprofile-name_view" name="CandidateProfile[name_view]" value="1" aria-invalid="false"> Hide Name In Public</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 p-r">
                                                    <?= $form->field($model, 'title')->textInput() ?>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 p-l">
                                                <?php $countries = ArrayHelper::map(Country::find()->where(['status' => 1])->orderBy(['country_name' => SORT_ASC])->all(), 'id', 'country_name'); ?>
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
                                                        'format' => 'dd-mm-yyyy'
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
                                                <label class="control-label" for="candidateprofile-executive_summary">Executive Summary</label>
                                                <textarea class="textarea" name="CandidateProfile[executive_summary]" style="width: 810px; height: 200px" id=""><?= $model->executive_summary ?></textarea>
                                            </div>
                                        </div>


                                        <!-- Industries -->
                                        <div class="form-group col-md-12 p-l p-r marg-bot-0">
                                            <?php
//                                            $skills = [];
                                            if (isset($model->industry) && $model->industry != '') {
                                                $model->industry = explode(',', $model->industry);
//                                                $skills = ArrayHelper::map(\common\models\Skills::find()->where(['in', 'industry', $model->industry])->all(), 'id', 'skill');
                                            }
                                            ?>
                                            <?php $industries = ArrayHelper::map(\common\models\Industry::find()->where(['status' => 1])->andWhere(['>', 'id', 0])->orderBy(['industry_name' => SORT_ASC])->all(), 'id', 'industry_name'); ?>
                                            <?= $form->field($model, 'industry')->dropDownList($industries, ['prompt' => 'Choose Industry', 'multiple' => 'multiple'])->label('Category') ?>
                                            <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-industry'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                                        </div>

                                        <div class="form-group col-md-12 p-l p-r marg-bot-0">
                                            <?php $skills = ArrayHelper::map(\common\models\Skills::find()->where(['status' => 1])->orderBy(['skill' => SORT_ASC])->all(), 'id', 'skill'); ?>
                                            <?php
                                            if (isset($model->skill) && $model->skill != '') {
                                                $model->skill = explode(',', $model->skill);
                                            }
                                            ?>
                                            <?= $form->field($model, 'skill')->dropDownList($skills, ['prompt' => 'Choose Skills', 'multiple' => 'multiple'])->label('Skills') ?>
                                            <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-skill'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                                        </div>
                                        <div class="clearfix"></div>

                                        <!-- Experience -->
                                        <label class="control-label" for="candidateprofile-experience">Experience</label>
                                        <div id="p_experience">
                                            <?php
                                            $i = 0;
                                            if (!empty($model_experience)) {
                                                foreach ($model_experience as $datas) {
                                                    if (!empty($datas)) {
                                                        $i++;
                                                        ?>
                                                        <div class="append-box">
                                                            <a id="expremove-<?= $datas->id; ?>" class="expremove remove"><i class="fa fa-close"></i></a>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <input type="text" name="expupdatee[<?= $datas->id; ?>][company_name][]" class="form-control" placeholder="Company" value="<?= $datas->company_name ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <input type="text" name="expupdatee[<?= $datas->id; ?>][designation][]" class="form-control" placeholder="Designation" value="<?= $datas->designation ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="formrow">
                                                                        <input id="exp_from_date-<?= $i ?>" type="date" name="expupdatee[<?= $datas->id; ?>][from_date][]" class="form-control exp-from-date" placeholder="Join From" value="<?= $datas->from_date ?>">
                                                                        <label for="chkispresent" class="chkbox-lbl">
                                                                            <input value="<?= $datas->present_status ?>" type="checkbox" data-val="<?= $datas->present_status ?>" class="chkispresent" id="chkispresent-<?= $i ?>" name="expupdatee[<?= $datas->id; ?>][present_status][]" <?= $datas->present_status == 1 ? ' checked' : '' ?>/>
                                                                            I currently work here
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="formrow">
                                                                        <div id="ispresent-<?= $i ?>" class="ispresent"  style="display: <?= $datas->present_status == 1 ? 'block' : 'none' ?>">
                                                                            Present
                                                                        </div>
                                                                        <div id="notpresent-<?= $i ?>" class="notpresent"  style="display: <?= $datas->present_status == 1 ? 'none' : 'block' ?>">
                                                                            <input id="exp_to_date-<?= $i ?>" type="date" name="expupdatee[<?= $datas->id; ?>][to_date][]" class="form-control exp-to-date" placeholder="End on" value="<?= $datas->to_date ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <select class="form-control" name="expupdatee[<?= $datas->id; ?>][country][]">
                                                                            <option value="">Select Country</option>
                                                                            <?php foreach ($country_datas as $country_data) { ?>
                                                                                <option value="<?= $country_data->id ?>" <?= $datas->country == $country_data->id ? 'selected' : '' ?>><?= $country_data->country_name ?></option>
                                                                            <?php }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="formrow">
                                                                        <textarea class="textarea form-control" name="expupdatee[<?= $datas->id; ?>][job_responsibility][]" placeholder="Job Responsibility"><?= $datas->job_responsibility ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            if ($i == 0) {
                                                $i = 1;
                                            } else {
                                                $i = $i + 1;
                                            }
                                            ?>
                                            <input type="hidden" id="experience_row_count" value="<?= $i ?>"/>
                                            <?php
//                                            if (empty($model_experience)) {
                                            ?>
                                            <div class="append-box">
                                                <a class="ibtnDele remove"><i class="fa fa-close"></i></a>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <input type="text" name="expcreate[company_name][]" class="form-control" placeholder="Company">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <input type="text" name="expcreate[designation][]" class="form-control" placeholder="Designation">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="formrow">
                                                            <input id="exp_from_date-<?= $i ?>" type="date" name="expcreate[from_date][]" class="form-control exp-from-date" placeholder="Join From" value="<?= date('Y-m-d', strtotime('-1 month')) ?>">
                                                            <label for="chkispresent" class="chkbox-lbl">
                                                                <input type="checkbox" id="chkispresent-<?= $i ?>" class="chkispresent" name="expcreate[present_status][]"/>
                                                                I currently work here
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div id="ispresent-<?= $i ?>" class="ispresent" style="display: none">
                                                            Present
                                                        </div>
                                                        <div id="notpresent-<?= $i ?>" class="notpresent">
                                                            <input id="exp_to_date-<?= $i ?>" type="date" name="expcreate[to_date][]" class="form-control exp-to-date" placeholder="End on" value="<?= date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <select class="form-control" name="expcreate[country][]">
                                                                <option value="">Select Country</option>
                                                                <?php foreach ($country_datas as $country_data) { ?>
                                                                    <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="formrow">
                                                            <textarea class="textarea form-control" name="expcreate[job_responsibility][]" placeholder="Job Responsibility"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
//                                            }
                                            ?>
                                        </div>
                                        <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                                            <a id="addexperience" class="btn btn-icon btn-blue addScnt btn-larger btn-block" ><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                        <div class="clearfix"></div>

                                        <br/>
                                        <div class="speration"></div>
                                        <!-- Education -->
                                        <label class="control-label" for="candidateprofile-education">Education</label>
                                        <div id="p_scents">
                                            <!--<input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">-->
                                            <?php
                                            $j = 0;
                                            if (!empty($model_education) && !$model->isNewRecord) {
                                                foreach ($model_education as $data) {
                                                    if (!empty($data)) {
                                                        $j++;
                                                        ?>
                                                        <div class="append-box">
                                                            <ul class="choose-qualification">
                                                                <li>
                                                                    <label data-val="<?= $data->id; ?>">
                                                                        <input data-val="<?= $data->id; ?>" type="radio" class="option-input radio set_highest" name="highest_qualification" <?= $data->highest_qualification == 1 ? 'checked' : '' ?>/>
                                                                        Highest Qualification
                                                                    </label>
                                                                </li>
                                                            </ul>
                                                            <a id="eduremove-<?= $data->id; ?>" class="eduremove remove"><i class="fa fa-close"></i></a>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <select class="form-control" name="updatee[<?= $data->id; ?>][qualification][]">
                                                                            <option value="">Select Qualification</option>
                                                                            <?php foreach ($course_datas as $course_data) { ?>
                                                                                <option value="<?= $course_data->id ?>" <?= $data->qualification == $course_data->id ? 'selected' : '' ?>><?= $course_data->course_name ?></option>
                                                                            <?php }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][course][]" value="<?= $data->course_name ?>" placeholder="Course Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="formrow">
                                                                        <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][college][]" value="<?= $data->collage_university ?>" placeholder="College / University">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="formrow">
                                                                        <input id="edu_from_date-<?= $j ?>" type="date" name="updatee[<?= $data->id; ?>][from_date][]" class="form-control edu-from-date" value="<?= $data->from_year ?>" placeholder="Join From">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="formrow">
                                                                        <input id="edu_to_date-<?= $j ?>" type="date" name="updatee[<?= $data->id; ?>][to_date][]" class="form-control edu-to-date" value="<?= $data->to_year ?>" placeholder="End On">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="formrow">
                                                                        <select class="form-control" name="updatee[<?= $data->id; ?>][country][]">
                                                                            <option value="">Select Country</option>
                                                                            <?php foreach ($country_datas as $country_data) { ?>
                                                                                <option value="<?= $country_data->id ?>" <?= $data->country == $country_data->id ? 'selected' : '' ?>><?= $country_data->country_name ?></option>
                                                                            <?php }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                            }
                                            if ($j == 0) {
                                                $j = 1;
                                            } else {
                                                $j = $j + 1;
                                            }
                                            ?>
                                            <input type="hidden" id="education_row_count" value="<?= $j ?>"/>
                                            <?php // if (empty($model_education)) { ?>
                                            <div class="append-box">
                                                <a class="ibtnDel remove"><i class="fa fa-close"></i></a>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <select class="form-control" name="create[qualification][]">
                                                                <option value="">Select Qualification</option>
                                                                <?php foreach ($course_datas as $course_data) { ?>
                                                                    <option value="<?= $course_data->id ?>"><?= $course_data->course_name ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <input type="text" class="form-control" name="create[course][]" placeholder="Course Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="formrow">
                                                            <input type="text" class="form-control" name="create[college][]" placeholder="College / University">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="formrow">
                                                            <input id="edu_from_date-<?= $j ?>" type="date" name="create[from_date][]" class="form-control edu-from-date" placeholder="Join From" value="<?= date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="formrow">
                                                            <input id="edu_to_date-<?= $j ?>" type="date" name="create[to_date][]" class="form-control edu-to-date" placeholder="Join From" value="<?= date('Y-m-d') ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="formrow">
                                                            <select class="form-control" name="create[country][]">
                                                                <option value="">Select Country</option>
                                                                <?php foreach ($country_datas as $country_data) { ?>
                                                                    <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
                                                                <?php }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php // }
                                            ?>
                                        </div>
                                        <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                                            <a id="addeducation" class="btn btn-icon btn-blue addScnt btn-larger btn-block" ><i class="fa fa-plus"></i> Add More</a>
                                        </div>
                                        <div class="clearfix"></div>

                                        <br/>
                                        <div class="form-group col-md-12 p-l p-r">
                                            <?= $form->field($model, 'hobbies')->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="form-group col-md-12 p-l p-r">
                                            <label class="control-label" for="candidateprofile-executive_summary">Extra Curricular Activities</label>
                                            <textarea class="textarea form-control" name="CandidateProfile[extra_curricular_activities]"><?= $model->extra_curricular_activities ?></textarea>
                                        </div>
                                        <div class="form-group col-md-6 p-l">
                                            <?php $languages = ArrayHelper::map(\common\models\Languages::find()->where(['status' => 1])->orderBy(['language' => SORT_ASC])->all(), 'id', 'language'); ?>
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
                                                    <div class="form-control change-cv">
                                                        <?= $form->field($model, 'upload_resume')->fileInput(['maxlength' => true])->label($label) ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-control download-cv">
                                                        <label class="control-label">Download CV</label>
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
                                        </div>
                                        <div class="form-group col-md-6 p-r">
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

//        $(document).on('change', '#candidateprofile-industry', function () {
//            var industry = $(this).val();
//            $.ajax({
//                type: 'POST',
//                cache: false,
//                async: false,
//                data: {industry: industry},
//                url: '<?= Yii::$app->homeUrl ?>candidate/get-skills',
//                success: function (data) {
//                    $('#candidateprofile-skill').html(data);
//                }
//            });
//        });
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
        $(document).on('click', '#addeducation', function (event) {
            var row_id = $('#education_row_count').val();
            var next = parseInt(row_id) + 1;
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {next: next},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-acadamics',
                success: function (data) {
                    $('#p_scents').append(data);
                }
            });
            counter++;
        });


        $(document).on('click', '.eduremove', function (event) {
            event.preventDefault();
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-acadamics',
                success: function (data) {
                    if (data == 1) {
                        $('#eduremove-' + current_row_id).parents('.append-box').remove();
                    }
                }
            });
        });


    });
</script>
<script>
    $(document).ready(function () {
        $(document).on('change', '#candidateprofile-photo', function () {
            var url = "<?= Yii::$app->homeUrl ?>candidate/upload-profile";
            ajaxFormSubmit(url, '#w0', function (output) {
                var data = JSON.parse(output);
                if (data.status == 'success') {
                    var d = new Date();
                    var candidate_id = '<?= $candidate_id ?>';
                    if (candidate_id !== "") {
                        $("#profle_img_").attr("src", data.file + '?' + d.getTime());
                    } else {
                        $("#profle_img_temp").attr("src", data.file + '?' + d.getTime());
                    }
                    $('.im_progress').fadeOut();
                } else {
                    alert("Something went wrong.Please try again.");
                    $(".img_preview").hide();
                }

            });
        });

        function ajaxFormSubmit(url, form, callback) {
            var formData = new FormData($(form)[0]);
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                datatype: 'json',
                beforeSend: function () {
// do some loading options
                },
                success: function (data) {
                    callback(data);
                },
                complete: function () {
// success alerts
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
        $(document).on('click', '#addexperience', function (event) {
            var row_id = $('#experience_row_count').val();
            var next = parseInt(row_id) + 1;
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {next: next},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-experience',
                success: function (data) {
                    $('#experience_row_count').val(next);
                    $('#p_experience').append(data);
                    $('.textarea').wysihtml5();
                }
            });
        });
        $(document).on('click', '.ibtnDele', function () {
            $(this).parents('.append-box').remove();
            return false;
        });
        $(document).on('click', '.ibtnDel', function () {
            $(this).parents('.append-box').remove();
            return false;
        });
        $(document).on('click', '.expremove', function (event) {
            event.preventDefault();
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-experience',
                success: function (data) {
                    if (data == 1) {
                        $('#expremove-' + current_row_id).parents('.append-box').remove();
                    }
                }
            });
        });
        $(document).on('change', 'input[type=radio][name=highest_qualification]', function (event) {
            event.preventDefault();
            var Id = $(this).attr('data-val');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: "id=" + Id,
                url: '<?= Yii::$app->homeUrl ?>candidate/set-highest',
                success: function (data) {
                }
            });
        });
        $(document).on('blur', '.exp-from-date', function (event) {
            var current_row_id = $(this).attr('id').match(/\d+/);
            getFromDate(current_row_id);
        });
        $(document).on('blur', '.exp-to-date', function (event) {
            var current_row_id = $(this).attr('id').match(/\d+/);
            getToDate(current_row_id);
        });
        $(document).on('blur', '.edu-from-date', function (event) {
            var current_row_id = $(this).attr('id').match(/\d+/);
            getEduFromDate(current_row_id);
        });
        $(document).on('blur', '.edu-to-date', function (event) {
            var current_row_id = $(this).attr('id').match(/\d+/);
            getEduToDate(current_row_id);
        });
        $(document).on('click', '.chkispresent', function (event) {
            var current_row_id = $(this).attr('id').match(/\d+/);
            if ($(this).is(":checked")) {
                $("#ispresent-" + current_row_id).show();
                $("#notpresent-" + current_row_id).hide();
                $("#chkispresent-" + current_row_id).val(1);
                getFromDate(current_row_id);
            } else {
                $("#ispresent-" + current_row_id).hide();
                $("#notpresent-" + current_row_id).show();
                $("#chkispresent-" + current_row_id).val(2);
                var strDate = '<?php echo $current_date; ?>';
                $('#exp_to_date-' + current_row_id).val(strDate);
                getFromDate(current_row_id);
            }
        });
        $(document).on('click', '.modalButton', function () {

            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr("value"));
        });
    });
    function getToDate(current_row_id) {
        var to_date = $('#exp_to_date-' + current_row_id).val();
        var from_date = $('#exp_from_date-' + current_row_id).val();
        if (to_date < from_date) {
            var strDate = '<?php echo $current_date; ?>';
            $('#exp_to_date-' + current_row_id).val(strDate);
            alert('To date must be greater than from date');
        }
    }
    function getFromDate(current_row_id) {
        var from_date = $('#exp_from_date-' + current_row_id).val();
        var to_date = $('#exp_to_date-' + current_row_id).val();
        if (to_date == '') {
            to_date = '<?php echo $current_date; ?>';
        }
        if (from_date > to_date) {
            alert('From date must be less than to date');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: "to_date=" + to_date,
                url: '<?= Yii::$app->homeUrl ?>candidate/get-from-date',
                success: function (data) {
                    $('#exp_from_date-' + current_row_id).val(data);
                }
            });
        }
    }
    function getEduToDate(current_row_id) {
        var to_date = $('#edu_to_date-' + current_row_id).val();
        var from_date = $('#edu_from_date-' + current_row_id).val();
        if (to_date < from_date) {
            var strDate = '<?php echo $current_date; ?>';
            $('#edu_to_date-' + current_row_id).val(strDate);
            alert('To date must be greater than from date');
        }
    }
    function getEduFromDate(current_row_id) {
        var from_date = $('#edu_from_date-' + current_row_id).val();
        var to_date = $('#edu_to_date-' + current_row_id).val();
        if (from_date > to_date) {
            alert('From date must be less than to date');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: "to_date=" + to_date,
                url: '<?= Yii::$app->homeUrl ?>candidate/get-from-date',
                success: function (data) {
                    $('#edu_from_date-' + current_row_id).val(data);
                }
            });
        }
    }
    function experienceCheck() {
        var row_count = $('#experience_row_count').val();
        for (i = 1; i < row_count; i++) {
            var exval = $('#chkispresent-' + i).attr("data-val");
            if (exval == 1) {
                $("#ispresent-" + i).show();
                $("#notpresent-" + i).hide();
            } else {
                $("#ispresent-" + i).hide();
                $("#notpresent-" + i).show();
            }
        }
    }
</script>
<script src="<?= Yii::$app->homeUrl ?>js/wysihtml5-0.3.0.js"></script>
<script src="<?= Yii::$app->homeUrl ?>js/bootstrap-wysihtml5.js"></script>

<script>
    $('.textarea').wysihtml5();
</script>
