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
?>
<div class="sorting_content">
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
        <div class="overflow">
            <div class="bottom_text">
                <div class="tab-image"><img src="images/candidates/candidate-2.png" alt="" class="img-responsive"></div>
                <div class="text-shorting">
                    <h1><?= $model->name ?></h1>
                    <ul class="unstyled">
                        <li><?= $model->title ?></li>
                    </ul>
                </div>
                <div class="contact_details col-md-4 col-sm-4 p-l">
                    <span><strong>Nationality:</strong> <?= $model->nationality != '' ? common\models\Country::findOne($model->nationality)->country_name : '' ?></span>
                </div>
                <div class="contact_details col-md-6 col-sm-6 p-l">
                    <span><strong>Currently:</strong> <?= $model->current_country != '' ? common\models\Country::findOne($model->current_country)->country_name : '' ?> <?= $model->current_city != '' ? ', ' . common\models\City::findOne($model->current_city)->city : '' ?></span>
                </div>
                <p class="col-md-12 p-l"><?= $model->executive_summary ?></p>
                <div class="contact_details col-md-12 col-sm-12 p-l">
                    <span><strong>Job Status:</strong> <?= $model->job_status ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 p-l">
        <div class="button-box">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0">
                <a href="" class="button1">Shortlist to Folder <br><span>CVs for sales</span></a>
                <a href="" class="button2">Quick Download <br><span><i class="fas fa-file-pdf"></i></span></a>
                <?= Html::a('View CV <br><span><i class="fas fa-eye"></i></span>', ['view-cv', 'id' => $model->id], ['class' => 'button3']) ?>
            </div>
        </div>
    </div>
    <div class="bottom-box col-lg-12">
        <div class="last-login col-md-6 col-sm-6 p-l">
            <span><i>Last Logged in : <?= $last_login ?></i></span>
        </div>
        <div class="last-login col-md-6 col-sm-6 p-l">
            <span><em>4 Other Employers Shortlisted this CV</em></span>
        </div>
    </div>
</div>

