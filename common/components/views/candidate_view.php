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
    $date2 = $experiences->to_date;

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
if (count($short_list_data) > 0) {
    $msg = count($short_list_data) . ' Other Employers Shortlisted this CV';
} else {
    $msg = 'No Other Employers Shortlisted this CV';
}
$qualification = common\models\CandidateEducation::find()->where(['candidate_id' => $model->candidate_id])->orderBy(['to_year' => SORT_DESC])->one();
$work_experiences = \common\models\WorkExperiance::find()->where(['candidate_id' => $model->candidate_id])->limit(3)->orderBy(['to_date' => SORT_DESC])->all();
?>
<?php if ($candidate->status == 1) { ?>
    <div class="sorting_content">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 prit0" id="leftdiv">
            <div class="overflow">
                <div class="bottom_text">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pad0">
                        <div class="tab-image">
                            <?php
                            if ($model->photo != '') {
                                $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                if (file_exists($dirPath)) {
                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                } else {
                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="contact_details col-lg-10 col-md-10 col-sm-10 col-xs-10">
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
                                <span class="employed-still-looking"><?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
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
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 p-l prit0" id="rightdiv">
            <div class="button-box prit0">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                    <div class="contact_details col-md-12 col-sm-12 p-r refid">
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
                            <?php // Html::a('Quick Download <br><span><i class="fas fa-file-pdf"></i>', ['quick-download', 'id' => $model->id], ['class' => 'button2'])  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="contact_details p-l skills-sec">
                <span><strong>Skills:</strong> 
                    <ul class="skills-list">
                        <li>Core Java</li>
                        <li>Core Java</li>
                        <li>Core Java</li>
                    </ul>
                </span>
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
<?php } else { ?>
    <div class="sorting_content">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
            <div class="overflow">
                <div class="bottom_text">
                    <div class="contact_details col-md-12 col-sm-12 p-l">
                        <h2><strong>Employee Details Not Available</strong></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-box col-lg-12">
            <div class="last-login col-md-6 col-sm-6 p-l">
                <span><i>Last Logged in : <?= $last_login ?></i></span>
            </div>
            <div class="last-login col-md-6 col-sm-6 p-l">
                <span><em><?= $msg ?></em></span>
            </div>
        </div>
    </div>
<?php }
?>