<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<main id="maincontent" class="my-account jobseaker-cv-view">
    <section class="resume manage">
        <div class="container">

            <div class="row">
                <div class="col-lg-2 col-md-3 col-sm-3 col-lg-12">
                    <aside  id="target" class="aside">
                        <h4 class="title">My Account</h4>
                        <ul>
                            <li><?= Html::a('User Details', ['/candidate/index']) ?></li>
                            <li><?= Html::a('Profile Edit', ['/candidate/update-profile']) ?></li>
                            <li class="active"><?= Html::a('CV View', ['/candidate/online-curriculum-vitae']) ?></li>
                            <li><?= Html::a('Reset Password', ['/candidate/reset-password']) ?></li>
                        </ul>
                    </aside>
                </div>
                <div class="col-lg-10 col-md-9 col-sm-9 col-lg-12">
                    <div class="rightside-box">
                        <!-- Job Header start -->
                        <div class="job-header">
                            <div class="jobinfo">
                                <div class="row">
                                    <div class="col-md-8"> 
                                        <!-- Candidate Info -->
                                        <?php if (!empty($model)) { ?>
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
                                                <div class="title"><?= $user_details->user_name ?></div>
                                                <div class="desi"><?= $model->title ?></div>
                                                <div class="loctext"><i class="fa fa-flag" aria-hidden="true"></i>Nationality: <?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></div>
                                                <div class="loctext"><i class="fa fa-map-marker" aria-hidden="true"></i>Currently: <?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?> , <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></div>
                                                <div class="loctext">
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
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4"> 
                                        <!-- Candidate Contact -->
                                        <?php if (!empty($model)) { ?>
                                            <div class="candidateinfo cont-right jobdetail">
                                                <h3 class="mt0">Contact Info</h3>
                                                <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <?= $user_details->phone ?><?= $user_details->alternate_phone != '' ? ', ' . $user_details->alternate_phone : '' ?></div>
                                                <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $user_details->email ?></div>
                                                <!--<div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> www.mywebsite.com</div>-->
                                                <div class="cadsocial"> <a href="<?= $user_details->google_link ?>" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="<?= $user_details->facebook_link ?>" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="<?= $user_details->linked_in_link ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>  <a href="<?= $user_details->youtube_link ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>  </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="jobButtons"> 
                                <?= Html::a('<i class="fa fa-paper-plane" aria-hidden="true"></i> Edit my online CV', ['update-profile'], ['class' => 'btn apply']) ?>
                                <?= Html::a('<img width="20" src="' . Yii::$app->homeUrl . 'images/pdf-icon.png" > Download my online CV', ['pdf-export'], ['target' => '_blank', 'class' => 'btn']) ?>
                            </div>
                        </div>

                        <!-- Job Detail start -->
                        <?php if (!empty($model)) { ?>
                            <div class="row">
                                <div class="col-lg-8"> 
                                    <!-- About Employee start -->
                                    <div class="job-header">
                                        <div class="contentbox pad0">
                                            <div class="page-heading">
                                                <h3>Executive summary</h3>
                                                <div class="contact_details col-md-12 p-l">
                                                    <p><?= $model->executive_summary ?></p>
                                                </div>
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
                                                                <span> <?= date("M Y", strtotime($experience->from_date)) ?> - <?= !empty($experience->to_date) ? date("M Y", strtotime($experience->to_date)) : 'Present' ?></span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <br>
                                                            <span>Job Responsibilities: <?= $experience->job_responsibility ?></span>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </div>
                                            <div class="page-heading cv-work-experience">
                                                <h3>Education - Academic</h3>
                                                <div class="table-responsive">
                                                    <?php
                                                    if (!empty($model_education)) {
                                                        ?>
                                                        <table class="table inner-tbl1">
                                                            <tr>
                                                                <th>Course Name</th>
                                                                <th>Colege/ University</th>
                                                                <th>Country</th>
                                                                <th>From</th>
                                                                <th>To</th>
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

                                                </div>
                                            </div>
                                            <div class="page-heading">
                                                <h3>Interests/ Hobbies</h3>
                                                <div class="contact_details col-md-12 p-l">
                                                    <span><?= $model->hobbies ?></span>
                                                </div>

                                            </div>
                                            <div class="page-heading">
                                                <h3>Extra Curricular Activities</h3>
                                                <div class="contact_details col-md-12 p-l">
                                                    <span><?= $model->extra_curricular_activities ?></span>
                                                </div>

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
                                <div class="col-lg-4"> 
                                    <!-- Candidate Detail start -->
                                    <div class="job-header">
                                        <div class="jobdetail">
                                            <h3>Candidate Detail</h3>
                                            <ul class="jbdetail">
                                                <li class="row">
                                                    <div class="col-md-6 col-xs-6">Reference No:</div>
                                                    <div class="col-md-6 col-xs-6"><span> <?= $user_details->user_id ?></span></div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-6 col-xs-6">Job Type:</div>
                                                    <div class="col-md-6 col-xs-6"><span> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></span></div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-6 col-xs-6">Exp Salary($):</div>
                                                    <div class="col-md-6 col-xs-6"> <span class="freelance"> <?= $model->expected_salary != '' ? \common\models\ExpectedSalary::findOne($model->expected_salary)->salary_range : '' ?></span></div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-6 col-xs-6">Gender:</div>
                                                    <div class="col-md-6 col-xs-6"><span><?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?>  </span></div>
                                                </li>
                                                <li class="row">
                                                    <div class="col-md-6 col-xs-6">Date of birth:</div>
                                                    <div class="col-md-6 col-xs-6"><span> <?= date('d M Y', strtotime($model->dob)) ?> </span></div>
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
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script type="text/javascript">
    $('#candidateprofile-upload_resume').bind('change', function (e) {
        var fileExtension = ['pdf', 'doc'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : " + fileExtension.join(', '));
        } else {
            var f = this.files[0]
            if (f.size > 2097152 || f.fileSize > 2097152)
            {
                alert("Allowed file size exceeded. (Max. 2 MB)")
                this.value = null;
            } else {
                $("#cv-upload").submit();
            }
        }
    });
</script>
