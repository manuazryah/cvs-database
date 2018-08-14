<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<body style="font-size: 14px;
    line-height: 1.42857143;
    color: #2c2e2f;
    background-color: #fff;
    font-family: 'Montserrat', sans-serif;">
<main id="maincontent" class="my-account">
    <section class="resume manage">
        <div class="container" style=" width: 65%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
            <div class="row" style="margin-right: -15px; margin-left: -15px;">
                <div class="col-md-12" style="width: 100%;">
                    <div class="rightside-box" style="background: #ffffff; margin-top: 25px; margin-bottom: 60px; padding: 22px; border: solid 1px #e1e1e1; border-radius: 0px;">
                        <!-- Job Header start -->
                        <div class="job-header" style="background: #fff; border: 1px solid #e4e4e4; margin-bottom: 30px;">
                            <div class="jobinfo" style="padding: 25px; border-bottom: 1px solid #e4e4e4;">
                                <div class="row" style="margin-right: -15px; margin-left: -15px;">
                                    <div class="col-md-12 col-sm-12" style="width: 100%;"> 
                                        <!-- Candidate Info -->
                                        <div class="candidateinfo im-user-detail">
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 25%; margin-right: 15px;">
                                                        <?php
                                                        if ($model->photo != '') {
                                                            $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                                            if (file_exists($dirPath)) {
                                                                echo '<img class="img-responsive"  style="vertical-align: middle; display: block; max-width: 100%; height: auto;" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                            } else {
                                                                echo '';
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    <td style="width: 52%">
                                                        <table style="width: 100%">
                                                            <tr><td colspan="2"><strong><h4 style="font-size: 22px; margin-bottom: 10px; text-transform: capitalize;"><?= $model->name ?></h4></strong></td></tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Title : </strong><?= $model->title ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Job Status : </strong> <?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Nationality : </strong><?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Currently:</strong> <?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?> , <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Phone : </strong> <?= $candidate->phone ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px; font-size: 15px; font-weight: 300;"><strong>Email : </strong> <?= $candidate->email ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td style="width: 30%">
                                                        <table style="width: 100%">
                                                            <tr>
                                                                <td style="line-height: 22px;"><strong>Reference No : </strong><?= $candidate->user_id ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px;"><strong>Job Type : </strong> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px;"><strong>Expected Salary : </strong> <?= $model->expected_salary ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px;"><strong>Gender : </strong> <?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="line-height: 22px;"><strong>DOB : </strong> <?= $model->dob ?></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Job Detail start -->
                        <div class="row">
                            <div class="col-md-12"> 
                                <!-- About Employee start -->
                                <div class="job-header" style="background: #fff; border: 1px solid #e4e4e4; margin-bottom: 30px;">
                                    <div class="contentbox pad0">
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Executive summary</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important; font-size: 14px; line-height: 1.42857143; color: #2c2e2f; background-color: #fff; font-family: 'Montserrat', sans-serif;">
                                                <p style="line-height: 24px; color: #555; margin-bottom: 20px;"><?= $model->executive_summary ?></p>
                                            </div>
                                        </div>
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Industry</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important;">
                                                <p style="line-height: 24px; color: #555; margin-bottom: 20px;">
                                                    <?php
                                                    $result = '';
                                                    if ($model->industry != '') {
                                                        $industry = explode(',', $model->industry);
                                                        $i = 0;
                                                        if (!empty($industry)) {
                                                            foreach ($industry as $val) {
                                                                $industries = common\models\Industry::findOne($val);
                                                                if ($industries->status == 1) {
                                                                    if ($i != 0) {
                                                                        $result .= ', ';
                                                                    }
                                                                    $result .= $industries->industry_name;
                                                                    $i++;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    echo $result;
                                                    ?>
                                                </p>
                                            </div>

                                        </div>
                                        <div class="page-heading cv-work-experience" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Work Experience</h3>
                                            <?php
                                            if (!empty($model_experience)) {
                                                foreach ($model_experience as $experience) {
                                                    ?>
                                                    <div class="contact_details" style="padding-left: 10px !important; padding: 11px 15px; border: 1px solid #eceaea; margin-bottom: 20px;">
                                                        <div class="fleft" style="float: left; display: inline-block;">
                                                            <span style="margin-top: 0px; line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;"><strong style="color: #333; font-size: 14px; font-weight: 600; line-height: 35px;"><?= $experience->designation ?> <br> <span class="wrk-exp" style="display: inline-block; color: #403f3f; font-style: italic;"><?= $experience->company_name ?>  <?= $experience->country != '' ? ' in ' . common\models\Country::findOne($experience->country)->country_name : '' ?></span></strong></span>
                                                        </div>
                                                        <div class="fright" style="float: right; display: inline-block;">
                                                            <span style="margin-top: 34px; line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 13px; text-transform: capitalize;"> <?= date("M Y", strtotime($experience->from_date)) ?> - <?= $experience->present_status == 1 ? 'present' : date("M Y", strtotime($experience->to_date)) ?></span>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <br>
                                                        <span style="margin-top: 0px; line-height: 24px; color: #555; display: inline-block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;">Job Responsibilities: <?= $experience->job_responsibility ?></span>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </div>
                                        <div class="page-heading cv-work-experience" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Education - Academic</h3>
                                            <?php
                                            if (!empty($model_education)) {
                                                ?>
                                                <table class="table inner-tbl1" style="padding: 11px 15px; margin-bottom: 20px; width: 100%; margin: 0 auto;">
                                                    <tr style="border: 1px solid #eceaea;">
                                                        <th style="text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;">Course Name</th>
                                                        <th style="text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;">Colege/ University</th>
                                                        <th style="text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;">Country</th>
                                                        <th style="text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;">From</th>
                                                        <th style="text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;">To</th>
                                                    </tr>
                                                    <?php foreach ($model_education as $education) { ?>
                                                        <tr style="border: 1px solid #eceaea;">
                                                            <td style="border: 1px solid #eceaea; text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;"><?= $education->course_name ?></td>
                                                            <td style="border: 1px solid #eceaea; text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;"><?= $education->collage_university ?></td>
                                                            <td style="border: 1px solid #eceaea; text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;"><?= $education->country != '' ? \common\models\Country::findOne($education->country)->country_name : '' ?></td>
                                                            <td style="border: 1px solid #eceaea; text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;"><?= date("M Y", strtotime($education->from_year)) ?></td>
                                                            <td style="border: 1px solid #eceaea; text-align: left; line-height: 1.42857143; border: 1px solid #eceaea; font-size: 12px; vertical-align: middle; color: #7d7d7d; padding: 10px;"><?= date("M Y", strtotime($education->to_year)) ?></td>
                                                        </tr>
                                                    <?php }
                                                    ?>
                                                </table>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Interests/ Hobbies</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important;">
                                                <span style="line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;"><?= $model->hobbies ?></span>
                                            </div>

                                        </div>
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Extra Curricular Activities</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important;">
                                                <span style="line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;"><?= $model->extra_curricular_activities ?></span>
                                            </div>

                                        </div>
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Languages Known</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important;">
                                                <span style="line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;">
                                                    <?php
                                                    if ($model->languages_known != '') {
                                                        $language = explode(',', $model->languages_known);
                                                        $result2 = '';
                                                        $i = 0;
                                                        if (!empty($language)) {
                                                            foreach ($language as $language_data) {

                                                                if ($i != 0) {
                                                                    $result2 .= ', ';
                                                                }
                                                                $languages = common\models\Languages::findOne($language_data);
                                                                $result2 .= $languages->language;
                                                                $i++;
                                                            }
                                                        }
                                                        echo $result2;
                                                    }
                                                    ?>
                                                </span>
                                            </div>

                                        </div>
                                        <div class="page-heading" style="padding-bottom: 20px;">
                                            <h3 style="background: #403f3f; padding: 8px 10px; color: white; font-size: 15px; font-weight: 500; margin-top: 0px;">Driving License</h3>
                                            <div class="contact_details col-md-12 p-l" style="padding-left: 10px !important;">
                                                <span  style="line-height: 24px; color: #555; display: block; padding-bottom: 0px; font-size: 12px; text-transform: capitalize;">
                                                    <?php
                                                    if ($model->driving_licences != '') {
                                                        $driving_licence = explode(',', $model->driving_licences);
                                                        $result3 = '';
                                                        $i = 0;
                                                        if (!empty($driving_licence)) {
                                                            foreach ($driving_licence as $driving_licence_data) {

                                                                if ($i != 0) {
                                                                    $result3 .= ', ';
                                                                }
                                                                $driving_licences = common\models\Country::findOne($driving_licence_data);
                                                                $result3 .= $driving_licences->country_name;
                                                                $i++;
                                                            }
                                                        }
                                                        echo $result3;
                                                    }
                                                    ?>
                                                </span>
                                            </div>

                                        </div>
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
</body>