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
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


            </div>
            <div class="panel-body">
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Candidate</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-pencil"></i><span> Contact Details</span>', ['update', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-edit"></i><span> Update Profile</span>', ['update-profile', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-ban"></i><span> Disable Profile</span>', ['disable-profile', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa fa-lock"></i><span> Reset Password</span>', ['reset-password', 'id' => $candidate->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <div class="panel-body">
                    <div class="candidate-view">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel-body resume-panel">
                                    <main id="maincontent">
                                        <section class="resume">
                                            <div class="container-cv-view">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel-body">
                                                            <div class="col-md-12">
                                                                <h4><?= $model->name ?></h4>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="page-heading">
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Title:</strong> <?= $model->title ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Reference No:</strong> <?= $candidate->user_id ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Nationality:</strong> <?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Currently:</strong> </strong><?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?> , </strong> <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Expected Salary :</strong> <?= $model->expected_salary != '' ? \common\models\ExpectedSalary::findOne($model->expected_salary)->salary_range : '' ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Job Type:</strong> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Gender:</strong> <?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>DOB:</strong> <?= $model->dob ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Email:</strong> <?= $candidate->email ?></span>
                                                                    </div>
                                                                    <div class="contact_details col-md-6 p-l">
                                                                        <span><strong>Phone:</strong> <?= $candidate->phone ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 author">
                                                                <?php
                                                                if ($model->photo != '') {
                                                                    $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/../uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                                                    if (file_exists($dirPath)) {
                                                                        echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . '../uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                                    } else {
                                                                        echo '';
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="col-md-12"><div class="borderfull-width"></div></div>
                                                            <div class="col-md-12">
                                                                <div class="page-heading">
                                                                    <h4>Job Status</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span><?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Executive summary</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span><?= $model->executive_summary ?></span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Industry</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span>
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
                                                                        </span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Key Skills</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span>
                                                                            <?php
                                                                            if ($model->skill != '') {
                                                                                $skill = explode(',', $model->skill);
                                                                                $result1 = '';
                                                                                $i = 0;
                                                                                if (!empty($skill)) {
                                                                                    foreach ($skill as $value) {

                                                                                        if ($i != 0) {
                                                                                            $result1 .= ', ';
                                                                                        }
                                                                                        $skills = common\models\Skills::findOne($value);
                                                                                        $result1 .= $skills->skill;
                                                                                        $i++;
                                                                                    }
                                                                                }
                                                                                echo $result1;
                                                                            }
                                                                            ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Work Experience</h4>
                                                                    <?php
                                                                    if (!empty($model_experience)) {
                                                                        foreach ($model_experience as $experience) {
                                                                            ?>
                                                                            <div class="contact_details">
                                                                                <span><strong><?= $experience->designation ?> at <?= $experience->company_name ?></strong></span>
                                                                                <span>From : <?= date("M Y", strtotime($experience->from_date)) ?> to <?= date("M Y", strtotime($experience->to_date)) ?></span>
                                                                                <span>Job Responsibilities:</span>
                                                                                <span><?= $experience->job_responsibility ?></span>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Education - Academic</h4>
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
                                                                                    <td><?= $education->course_name != '' ? \common\models\Courses::findOne($education->course_name)->cource_code : '' ?></td>
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
                                                                    <h4>Interests/ Hobbies</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span><?= $model->hobbies ?></span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Extra Curricular Activities</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <span><?= $model->extra_curricular_activities ?></span>
                                                                    </div>
                                                                    <div class="borderfull-width"></div>
                                                                </div>
                                                                <div class="page-heading">
                                                                    <h4>Languages Known</h4>
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
                                                                    <h4>Driving License</h4>
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
                                                                    <h4>Uploded CV</h4>
                                                                    <div class="contact_details col-md-12 p-l">
                                                                        <?php
                                                                        if ($model->upload_resume != '') {
                                                                            $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/../uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                                                            if (file_exists($dirPath)) {
                                                                                if ($model->upload_resume != '') {
                                                                                    if ($model->upload_resume == 'doc' || $model->upload_resume == 'docx') {
                                                                                        ?>
                                                                                                                                                                                                                                                                                                                                                                        <!--<iframe src="https://docs.google.com/gview?url=<?= Yii::$app->homeUrl ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" frameborder="no" style="width:100%;height:300px"></iframe>-->
                                                                                        <iframe src="https://docs.google.com/viewer?embedded=true&url=<?= Yii::$app->homeUrl ?>../uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" frameborder="no" style="width:100%;height:300px"></iframe>
                                                                                    <?php } elseif ($model->upload_resume == 'pdf') { ?>
                                                                                        <iframe src="<?= Yii::$app->homeUrl ?>../uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" width="100%" height="300px" frameborder="0" ></iframe>
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
                                                </div>
                                            </div>
                                        </section>
                                    </main>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel-body resume-panel">
                                    <div class="row cv-contact">
                                        <div class="col-md-12 p-l p-r"><h5 class="cv-contact-head">Contacts</h5></div>
                                        <div class="borderfull-width top-0"></div>
                                        <div class="cv-contact-details">
                                            <table class="table">
                                                <tr>
                                                    <th>Email</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->email ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Mob / Tel</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->phone ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Facebook Link</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->facebook_link ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Google Link</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->google_link ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Linked in Link</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->linked_in_link ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Youtube Link</th>
                                                    <th>:</th>
                                                    <td><?= $candidate->youtube_link ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="borderfull-width"></div>
                                    </div>
                                    <div class="row cv-downlod">
                                        <div class="col-md-6 p-l"><h5 class="cv-dwn-head">Download CV</h5></div>
                                        <div class="col-md-6 p-r">
                                            <?= Html::a('<img width="50" src="' . Yii::$app->homeUrl . '../images/pdf-icon.png" >', ['pdf-export', 'id' => $model->id], ['target' => '_blank']) ?>
                                            <?= Html::a('<img width="50" src="' . Yii::$app->homeUrl . '../images/word-icon.png" >', ['word-export', 'id' => $model->id], ['target' => '_blank']) ?>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


