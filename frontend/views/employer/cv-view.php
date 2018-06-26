<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CV for :' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modal fade" id="modal-6">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<main id="maincontent" class="my-account employer-cv-view">
    <section class="resume manage">
        <div class=""> 
            <!-- Job Header start -->
            <div class="job-header">
                <div class="jobinfo">
                    <div class="row">
                        <div class="col-md-8 col-sm-8"> 
                            <!-- Candidate Info -->
                            <div class="candidateinfo im-user-detail">
                                <div class="userPic"> <?php
                                    if ($model->photo != '') {
                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                        if (file_exists($dirPath)) {
                                            echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                        } else {
                                            echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-4.jpg"/>';
                                        }
                                    } else {
                                        echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'images/user-4.jpg"/>';
                                    }
                                    ?>
                                </div>
                                <div class="title"><?= $contact_info->user_name ?></div>
                                <div class="desi"><?= $model->title ?></div>
                                <div class="loctext"><i class="fa fa-flag" aria-hidden="true"></i> <?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></div>
                                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?> , <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></div>
                                <div class="loctext employed-looking"><i class="fa fa-cube" aria-hidden="true"></i> Employed but looking for job</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4"> 
                            <!-- Candidate Contact -->
                            <div class="candidateinfo cont-right jobdetail">
                                <h3 class="mt0">Contact Info</h3>
                                <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <?= $contact_info->phone ?></div>
                                <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $contact_info->email ?></div>
                                <div class="cadsocial"> <a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="<?= $contact_info->google_link ?>" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="<?= $contact_info->facebook_link ?>" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="<?= $contact_info->linked_in_link ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>  <a href="<?= $contact_info->youtube_link ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>  </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="jobButtons"> 
                    <?= \common\widgets\Alert::widget() ?>
                    <?php
                    $shortlist = common\models\ShortList::find()->where(['candidate_id' => $model->candidate_id, 'employer_id' => Yii::$app->session['employer_data']['id']])->one();
                    if (empty($shortlist)) {
                        ?>
                        <a href="" class="btn btn-warning button1 shortlist-folder" id="short-list-modal" data-val="<?= $model->candidate_id ?>"><i class="fa fa-heart-o" aria-hidden="true"></i>Shortlist to Folder</a>
                    <?php } else {
                        ?>
                        <span class="short-list-span">This CV is already shortlisted to <span style=""><em><?= $shortlist->folder_name ?></em></span></span>
                        <?= Html::a('<i class="fa fa-trash-o" aria-hidden="true"></i>Remove from shortlist', ['un-shortlist', 'id' => $model->candidate_id], ['class' => 'btn btn-warning button1 shortlist-folder', 'title' => 'Remove from Shortlist', 'style' => 'float: right; margin-top: -5px; margin-right: 0;']) ?>
                    <?php }
                    ?>
                </div>
            </div>

            <!-- Job Detail start -->
            <div class="">
                <div class="col-md-8 pl0"> 
                    <!-- About Employee start -->
                    <div class="job-header">
                        <div class="contentbox">
                            <div class="page-heading">
                                <h3>Executive summary</h3>
                                <div class="contact_details executive-sum-cont col-md-12 p-l">
                                    <p><?= $model->executive_summary ?></p>
                                </div>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Industry</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <p>
                                        <?php
                                        if ($model->industry != '') {
                                            $industry = explode(',', $model->industry);
                                            $result = '';
                                            $i = 0;
                                            if (!empty($industry)) {
                                                foreach ($industry as $val) {

                                                    if ($i != 0) {
                                                        $result .= ', ';
                                                    }
                                                    $industries = common\models\Industry::findOne($val);
                                                    $result .= $industries->industry_name;
                                                    $i++;
                                                }
                                            }
                                            echo $result;
                                        }
                                        ?>
                                    </p>
                                </div>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading cv-work-experience">
                                <h3>Work Experience</h3>
                                <?php
                                if (!empty($model_experience)) {
                                    foreach ($model_experience as $experience) {
                                        ?>
                                        <div class="contact_details">
                                            <div class="fleft">
                                                <span><strong><?= $experience->designation ?> <br> <span class="wrk-exp"><?= $experience->company_name ?>  <?= $experience->country != '' ? ' in ' . common\models\Country::findOne($experience->country)->country_name : '' ?></span></strong></span>
                                            </div>
                                            <div class="fright">
                                                <span> <?= date("M Y", strtotime($experience->from_date)) ?> - <?= date("M Y", strtotime($experience->to_date)) ?></span>
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                            <span>Job Responsibilities: <?= $experience->job_responsibility ?></span>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading cv-work-experience">
                                <h3>Education - Academic</h3>
                                <?php
                                if (!empty($model_education)) {
                                    ?>
                                    <table class="table inner-tbl1">
                                        <tr>
                                            <th>Course Name</th>
                                            <th>Colege/ University</th>
                                            <th>Country</th>
                                            <th>From Year</th>
                                            <th>To Year</th>
                                        </tr>
                                        <?php foreach ($model_education as $education) { ?>
                                            <tr>
                                                <td><?= $education->course_name ?></td>
                                                <td><?= $education->collage_university ?></td>
                                                <td><?= $education->country != '' ? \common\models\Country::findOne($education->country)->country_name : '' ?></td>
                                                <td><?= date("M Y", strtotime($education->from_year)) ?></td>
                                                <td><?= date("M Y", strtotime($education->to_year)) ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </table>
                                    <?php
                                }
                                ?>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Interests/ Hobbies</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <span><?= $model->hobbies ?></span>
                                </div>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Extra Curricular Activities</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <span><?= $model->extra_curricular_activities ?></span>
                                </div>
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Languages Known</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <span>
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
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Driving License</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <span>
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
                                <div class="borderfull-width"></div>
                            </div>
                            <div class="page-heading">
                                <h3>Uploded CV</h3>
                                <div class="contact_details col-md-12 p-l">
                                    <?php
                                    if ($model->upload_resume != '') {
                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                        if (file_exists($dirPath)) {
                                            if ($model->upload_resume != '') {
                                                if ($model->upload_resume == 'doc' || $model->upload_resume == 'docx') {
                                                    $url = 'http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                                    ?>
                                                    <iframe src='https://docs.google.com/viewer?url=<?= $url ?>&embedded=true' frameborder='0' width="100%" height="300px"></iframe>
                                                <?php } elseif ($model->upload_resume == 'pdf') { ?>
                                                    <iframe src="<?= Yii::$app->homeUrl ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" width="100%" height="300px" frameborder="0" ></iframe>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 pr0"> 
                    <!-- Candidate Detail start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3>Candidate Detail</h3>
                            <ul class="jbdetail">
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Reference No:</div>
                                    <div class="col-md-6 col-xs-6"><span> <?= $contact_info->user_id ?></span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Job Type:</div>
                                    <div class="col-md-6 col-xs-6"><span> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Expected Salary($):</div>
                                    <div class="col-md-6 col-xs-6"> <span class="freelance"> <?= $model->expected_salary != '' ? \common\models\ExpectedSalary::findOne($model->expected_salary)->salary_range : '' ?></span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Gender:</div>
                                    <div class="col-md-6 col-xs-6"><span><?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?>  </span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">DOB:</div>
                                    <div class="col-md-6 col-xs-6"><span> <?= $model->dob ?> </span></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Google Map start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3>Skills</h3>
                            <div class="skillswrap"> 
                                <span>
                                    <?php
                                    if ($model->skill != '') {
                                        $skill = explode(',', $model->skill);
                                        $result1 = '';
                                        $i = 0;
                                        if (!empty($skill)) {
                                            foreach ($skill as $value) {
                                                $skills = common\models\Skills::findOne($value);
                                                if ($skills->status == 1) {
                                                    if ($i != 0) {
                                                        $result1 .= ', ';
                                                    }
                                                    $result1 .= $skills->skill;
                                                    $i++;
                                                }
                                            }
                                        }
                                        echo $result1;
                                    }
                                    ?>
                                </span>
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
        $(document).on('click', '#short-list-modal', function (e) {
            e.preventDefault();
            var candidate_id = $(this).attr('data-val');
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {candidate_id: candidate_id},
                url: '<?= Yii::$app->homeUrl ?>employer/get-short-list',
                success: function (data) {
                    $(".modal-content").html(data);
                    $('#modal-6').modal('show', {backdrop: 'static'});
                }
            });
        });

        $(document).on('submit', '#shortlist-form', function (e) {
            e.preventDefault();
            var candidate_id = $('#shortlist-candate_id').val();
            var folder_name = $('#shortlist-folder_name').val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {candidate_id: candidate_id, folder_name: folder_name},
                url: '<?= Yii::$app->homeUrl ?>employer/save-shortlist',
                success: function (data) {
                    $('#modal-6').modal('hide');
                    location.reload();
                }
            });
        });
    }
    );
</script>


