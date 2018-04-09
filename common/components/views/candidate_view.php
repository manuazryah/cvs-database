<?php

use yii\helpers\Html;
use common\models\LoginHistory;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
?>
<div class="sorting_content">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="overflow">
            <div class="bottom_text">
                <div class="tab-image">
                    <?php
                    if ($model->photo != '') {
                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                        if (file_exists($dirPath)) {
                            echo '<img width="70" height="70" class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                        } else {
                            echo '<img width="70" height="70" class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                        }
                    }
                    ?>
                </div>
                <div class="text-shorting">
                    <h1><strong><?= $name ?></strong></h1>
                    <ul class="unstyled">
                        <li><?= strlen($model->title) > 60 ? substr($model->title, 0, 60) . '...' : $model->title; ?></li>
                    </ul>
                </div>
                <div class="contact_details col-md-4 col-sm-4 p-l">
                    <span><strong>Nationality:</strong> <?= $model->nationality != '' ? common\models\Country::findOne($model->nationality)->country_name : '' ?></span>
                </div>
                <div class="contact_details col-md-6 col-sm-6 p-l">
                    <span><strong>Currently:</strong> <?= $model->current_country != '' ? common\models\Country::findOne($model->current_country)->country_name : '' ?> <?= $model->current_city != '' ? ', ' . common\models\City::findOne($model->current_city)->city : '' ?></span>
                </div>
                <p class="col-md-12 p-l"><?= strlen($model->executive_summary) > 160 ? substr($model->executive_summary, 0, 160) . '...' : $model->executive_summary; ?></p>
                <div class="contact_details col-md-12 col-sm-12 p-l">
                    <span><strong>Job Status:</strong> <?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></span>
                </div>
                <div class="contact_details col-md-12 col-sm-12 p-l">
                    <span><strong>Total Experience:</strong> <?= $year . ' Year ' . $month . ' Month' ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 p-l">
        <div class="button-box" style="margin-top: 20px;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                <?php
                $shortlist = common\models\ShortList::find()->where(['candidate_id' => $model->candidate_id, 'employer_id' => Yii::$app->session['employer_data']['id']])->one();
                if (empty($shortlist)) {
                    ?>
                    <a href="" class="button1" id="short-list-modal" data-val="<?= $model->candidate_id ?>">Shortlist to Folder</a>
                <?php } else {
                    ?>
                    <p class="button5">Already Shortlisted</p>
                <?php }
                ?>
                <?php // Html::a('Quick Download <br><span><i class="fas fa-file-pdf"></i>', ['quick-download', 'id' => $model->id], ['class' => 'button2']) ?>
                <?= Html::a('View CV <br><span><i class="fas fa-eye"></i></span>', ['view-cv', 'id' => $model->id], ['class' => 'button3']) ?>
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