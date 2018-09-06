<?php

use yii\helpers\Html;
use common\models\LoginHistory;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$candidate = \common\models\Candidate::find()->where(['id' => $model->candidate_id])->one();
$log_history = LoginHistory::find()->where(['client_id' => $model->candidate_id])->orderBy(['id' => SORT_DESC])->one();
if (!empty($log_history)) {
    if ($log_history->log_in_time != '') {
        $last_login = date("d M Y", strtotime($log_history->log_in_time));
    }
} else {
    $last_login = '';
}
$model_experiences = \common\models\WorkExperiance::find()->where(['candidate_id' => $model->candidate_id])->all();
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
if ($model->name_view == 1) {
    $name = '**********';
} else {
    $name = $model->name;
}
$short_list_data = \common\models\ShortList::find()->where(['candidate_id' => $model->candidate_id])->andWhere(['!=', 'employer_id', Yii::$app->session['employer_data']['id']])->all();
$cvview_list_data = \common\models\CvViewHistory::find()->where(['candidate_id' => $model->candidate_id])->andWhere(['!=', 'employer_id', Yii::$app->session['employer_data']['id']])->all();
$short_list_count = [];
if (!empty($short_list_data)) {
    foreach ($short_list_data as $short_list_val) {
        $short_list_count[] = $short_list_val->employer_id;
    }
}
if (!empty($cvview_list_data)) {
    foreach ($cvview_list_data as $cvview_list_val) {
        $short_list_count[] = $cvview_list_val->employer_id;
    }
}
$short_list_count = array_unique($short_list_count);
if (count($short_list_count) > 0) {
    $msg = count($short_list_count) . ' Other employers viewed / shortlisted this CV';
} else {
    $msg = 'No Other Employers Shortlisted this CV';
}
$qualification = common\models\CandidateEducation::find()->where(['candidate_id' => $model->candidate_id])->orderBy(['to_year' => SORT_DESC])->one();
$work_experiences = \common\models\WorkExperiance::find()->where(['candidate_id' => $model->candidate_id])->limit(3)->orderBy(['to_date' => SORT_DESC])->all();
?>
<?php if ($profile_info->status == 1) { ?>
    <div class="sorting_content">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 prit0" id="leftdiv">
            <div class="contact_details p-r refid hidden-lg hidden-md hidden-sm vissible-xs">
                <span><strong>cv #</strong> <?= $profile_info->user_id ?></span>
            </div>
            <div class="overflow">
                <div class="bottom_text">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pad0  profile-image">
                        <div class="tab-image">
                            <?php
                            if ($model->photo != '') {
                                $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                if (file_exists($dirPath)) {
                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                } else {
                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                }
                            } else {
                                echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="contact_details col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="text-shorting">
                            <div class="contact_details p-l">
                                <h1><strong><?= $name ?></strong></h1>
                            </div>
                            <div class="contact_details p-l">
                                <ul class="unstyled">
                                    <li><span><?= strlen($model->title) > 60 ? substr($model->title, 0, 60) . '...' : $model->title; ?></span></li>
                                </ul>
                            </div>
                            <div class="contact_details p-l">
                                <?php
                                if ($model->job_status == 1) {
                                    $color = 'employed-still-looking';
                                } elseif ($model->job_status == 2) {
                                    $color = 'actively-looking';
                                } elseif ($model->job_status == 3) {
                                    $color = 'employed-not-looking';
                                } else {
                                    $color = '';
                                }
                                ?>
                                <span class="<?= $color ?>"><?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></span>
                            </div>
                        </div>
                        <div class="search-min">
                            <div class="contact_details col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                <ul class="firm">
                                    <?php
                                    if (!empty($work_experiences)) {
                                        foreach ($work_experiences as $work_experience) {
                                            ?>

                                            <li> <?= $work_experience->designation . ' at ' . $work_experience->company_name ?></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 p-l prit0" id="rightdiv">
            <?php
            if ($profile_info->status == 1) {
                ?>
                <div class="button-box prit0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                        <div class="contact_details col-md-12 col-sm-12 p-r refid hidden-xs">
                            <span><strong>cv #</strong> <?= $profile_info->user_id ?></span>
                        </div>
                        <div class="contact_details col-md-12 col-sm-12 p-l">
                            <span><strong>Exp:</strong><?= $year . ' Year ' . $month . ' Month' ?>
                        </div>
                        <div class="contact_details col-md-12 col-sm-12 p-l">
                            <span><strong>Expected Salary($):</strong>  <?= $model->expected_salary != '' ? \common\models\ExpectedSalary::findOne($model->expected_salary)->salary_range : '' ?></span>
                        </div>
                        <div class="contact_details col-md-12 col-sm-12 p-l">
                            <span><strong>Currently:</strong> <?= $model->current_country != '' ? common\models\Country::findOne($model->current_country)->country_name : '' ?> <?= $model->current_city != '' ? ', ' . common\models\City::findOne($model->current_city)->city : '' ?></span>
                        </div>
                        <div class="contact_details col-md-12 col-sm-12 p-l">
                            <span><strong>Nationality:</strong> <?= $model->nationality != '' ? common\models\Country::findOne($model->nationality)->country_name : '' ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-l prit0">
                    <div class="button-box ptop0">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                            <div class="button-sec">
                                <?= Html::a('View CV', ['view-cv', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id)], ['class' => 'button3']) ?>

                                <?php
                                $shortlist = common\models\ShortList::find()->where(['candidate_id' => $model->candidate_id, 'employer_id' => Yii::$app->session['employer_data']['id']])->one();
                                if (empty($shortlist)) {
                                    ?>
                                    <a href="" title="Add to Shortlist" class="button1 shortlist-folder" id="short-list-modal" data-val="<?= $model->candidate_id ?>"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                <?php } else {
                                    ?>
                                    <!--<p class="button5">Already Shortlisted</p>-->
                                    <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['un-shortlist', 'id' => $model->candidate_id], ['class' => 'button2 remove-shortlist', 'title' => 'Remove from Shortlist']) ?>
                                <?php }
                                ?>
                                <a href="" class="button1 fld-move mtop8" id="" data-val="<?= $model->candidate_id ?>">Change Folder</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-xs-12">
            <div class="contact_details p-l skills-sec">
                <span><strong>Skills:</strong> 
                    <ul class="skills-list">
                        <?php
                        $skill_datas = explode(',', $model->skill);
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
        <div class="bottom-box col-xs-12">
            <div class="last-login col-md-4 col-sm-4 col-xs-4 p-l">
                <span><i>Last Logged in : <?= $last_login ?></i></span>
            </div>
            <div class="last-login col-md-3 col-sm-3 col-xs-3 p-l">
                <?php if ($model->featured_cv == 1) { ?>
                    <span class="featured-tag">Featured</span>
                <?php }
                ?>
            </div>
            <div class="last-login col-md-5 col-sm-5 col-xs-5 p-l text-right">
                <span><em><?= $msg ?></em></span>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="sorting_content">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 prit0" id="leftdiv">
            <div class="overflow">
                <div class="bottom_text">
                    <h2><strong>Employee Details Not Available</strong></h2>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p-l prit0" id="rightdiv">
            <div class="button-box prit0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                    <div class="contact_details col-md-12 col-sm-12 p-r refid">
                        <span><strong>cv #</strong> <?= $profile_info->user_id ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-l prit0">
                <div class="button-box ptop0">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                        <div class="button-sec" style="float: right;">
                            <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['un-shortlist', 'id' => $model->candidate_id], ['class' => 'button2 remove-shortlist', 'title' => 'Remove from Shortlist']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-box col-lg-12">
            <div class="last-login col-md-6 col-sm-6 p-l">
                <span><i>Last Logged in : <?= $last_login ?></i></span>
            </div>
            <div class="last-login col-md-6 col-sm-6 p-l text-right">
                <span><em><?= $msg ?></em></span>
            </div>
        </div>
    </div>
<?php }
?>