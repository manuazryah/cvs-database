<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = 'Profile Details';
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Jobseekers</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-pencil"></i><span> Contact Details</span>', ['update', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-edit"></i><span> Update Profile</span>', ['update-profile', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-ban"></i><span> Disable Profile</span>', ['disable-profile', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-lock"></i><span> Reset Password</span>', ['reset-password', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body">
                    <div class="candidate-view">
                        <main id="maincontent" class="my-account employer-cv-view">
                            <section class="resume manage">
                                <div class=""> 
                                    <!-- Job Header start -->
                                    <div class="job-header">
                                        <div class="jobinfo">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8"> 
                                                    <!-- Candidate Info -->
                                                    <?php if (!empty($model)) { ?>
                                                    <div class="candidateinfo im-user-detail">
                                                        <div class="userPic">
                                                            <?php
                                                            if ($model->photo != '') {
                                                                $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/../uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                                                if (file_exists($dirPath)) {
                                                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . '../uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                                } else {
                                                                    echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . '../images/user-4.jpg"/>';
                                                                }
                                                            } else {
                                                                echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . '../images/user-4.jpg"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="title"><?= $model->name ?></div>
                                                        <div class="desi"><?= $model->title ?></div>
                                                        <div class="loctext"><i class="fa fa-flag" aria-hidden="true"></i> <?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></div>
                                                        <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?> , <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></div>
                                                        <div class="loctext employed-looking">
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
                                                        <div class="clearfix"></div>
                                                    </div>
                                                 <?php }?>
                                                </div>
                                                <div class="col-md-4 col-sm-4"> 
                                                    <!-- Candidate Contact -->
                                                    <div class="candidateinfo cont-right jobdetail">
                                                        <h3 class="mt0">Contact Info</h3>
                                                        <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i>  <?= $candidate->phone ?><?= $candidate->alternate_phone != '' ? ', ' . $candidate->alternate_phone : '' ?></div>
                                                        <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $candidate->email ?></div>
                                                        <div class="cadsocial"> <a href="<?= $candidate->google_link ?>" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="<?= $candidate->facebook_link ?>" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="<?= $candidate->linked_in_link ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>  <a href="<?= $candidate->youtube_link ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>  </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Job Detail start -->
                                    <?php if (!empty($model)) { ?>
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
                                                                                    $result .= $industries->industry_name;
                                                                                    $i++;
                                                                                }
                                                                            }
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
                                                                        <span><strong><?= $experience->designation ?> at <br> <span class="wrk-exp"><?= $experience->company_name ?>  <?= $experience->country != '' ? ' in ' . common\models\Country::findOne($experience->country)->country_name : '' ?></span></strong></span>
                                                                    </div>
                                                                    <div class="fright">
                                                                        <span> <?= date("M Y", strtotime($experience->from_date)) ?> - <?= date("M Y", strtotime($experience->to_date)) ?></span>
                                                                    </div>
                                                                    <div class="clearfix"></div>
                                                                    <br>
                                                                    <span><?= $experience->job_responsibility ?></span>
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
                                                                $result2 = '';
                                                                if ($model->languages_known != '') {
                                                                    $language = explode(',', $model->languages_known);
                                                                    
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
                                                                $result3 = '';
                                                                if ($model->driving_licences != '') {
                                                                    $driving_licence = explode(',', $model->driving_licences);
                                                                    
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
                                                            <div class="col-md-6 col-xs-6"><span> <?= $candidate->user_id ?></span></div>
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
                                                        <?php
                                                         $result1 = '';
                                                        if ($model->skill != '') {
                                                            $skill = explode(',', $model->skill);
                                                           
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
                                                        }
                                                        $result1_array = explode(',', $result1);
                                                        ?>
                                                        <div class="skills-sec">
                                                            <ul class="skills-list">
                                                                <?php
                                                                if (!empty($result1_array)) {
                                                                    foreach ($result1_array as $result1_val) {
                                                                        if ($result1_val != '') {
                                                                            ?>
                                                                            <li><?= $result1_val ?></li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php }?>
                                </div>
                            </section>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


