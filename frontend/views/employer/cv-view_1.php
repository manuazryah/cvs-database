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
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <!--                <div class="panel-heading">
                                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                                </div>-->
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    $shortlist = common\models\ShortList::find()->where(['candidate_id' => $model->candidate_id, 'employer_id' => Yii::$app->session['employer_data']['id']])->one();
                    if (empty($shortlist)) {
                        ?>
                        <a href="" class="btn btn-warning  btn-icon btn-icon-standalone" id="short-list-modal" data-val="<?= $model->candidate_id ?>" style="float:right;margin-left: 20px;"><i class="fa fa-folder-open-o"></i><span>Shortlist to Folder</span></a>
                    <?php } else {
                        ?>
                        <span class="short-list-span">Already Shortlisted</span>
                    <?php }
                    ?>
                    <?= Html::a('<i class="fa fa-download"></i><span> Quick Download</span>', ['quick-download', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right;']) ?>
                    <section class="resume">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-body" style="border: solid 1px #e1e1e1;border-radius: 2px;padding: 22px;position: relative;margin-bottom: 20px;">
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 90%">
                                                    <table style="width: 100%">
                                                        <tr><td colspan="2"><strong><h4 style="margin-bottom: 20px;"><?php // $model->name                                                          ?></h4></strong></td></tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Title : </strong><?= $model->title ?></td>
                                                            <td style="line-height: 30px;"><strong>Name : </strong><?= $contact_info->user_name ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Nationality : </strong><?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></td>
                                                            <td style="line-height: 30px;"><strong>Email:</strong> <?= $contact_info->email ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Current Country : </strong><?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?></td>
                                                            <td style="line-height: 30px;"><strong>Current City:</strong> <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Expected Salary : </strong> <?= $model->expected_salary != '' ? \common\models\ExpectedSalary::findOne($model->expected_salary)->salary_range : '' ?></td>
                                                            <td style="line-height: 30px;"><strong>Job Type : </strong> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Gender : </strong> <?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?></td>
                                                            <td style="line-height: 30px;"><strong>DOB : </strong> <?= $model->dob ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="line-height: 30px;"><strong>Phone : </strong> <?= $contact_info->phone ?></td>
                                                            <td style="line-height: 30px;"><strong>Reference Number : </strong> <?= $contact_info->user_id ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td style="width: 10%">
                                                    <?php
                                                    if ($model->photo != '') {
                                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                                        if (file_exists($dirPath)) {
                                                            echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                                        } else {
                                                            echo '';
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Job Status</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Executive summary</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><?= $model->executive_summary ?></td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Industry</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;">
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
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Key Skills</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;">
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
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Work Experience</strong></th>
                                            </tr>
                                            <?php
                                            if (!empty($model_experience)) {
                                                foreach ($model_experience as $experience) {
                                                    ?>
                                                    <tr>
                                                        <td style="line-height: 30px;">
                                                            <span><?= $experience->designation ?> at <?= $experience->company_name ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 30px;">
                                                            <span>From : <?= date("M Y", strtotime($experience->from_date)) ?> to <?= date("M Y", strtotime($experience->to_date)) ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 30px;">
                                                            <span>Job Responsibilities:</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="line-height: 30px;">
                                                            <span><?= $experience->job_responsibility ?></span>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th colspan="5" style="line-height: 30px;"><strong>Education - Academic</strong></th>
                                            </tr>
                                            <?php
                                            if (!empty($model_education)) {
                                                ?>
                                                <tr>
                                                    <th style="line-height: 35px;">Course Name</th>
                                                    <th style="line-height: 35px;">Colege/ University</th>
                                                    <th style="line-height: 35px;">Country</th>
                                                    <th style="line-height: 35px;">From Year</th>
                                                    <th style="line-height: 35px;">To Year</th>
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
                                                <?php
                                            }
                                            ?>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Interests/ Hobbies</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><?= $model->hobbies ?></td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Extra Curricular Activities</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><?= $model->extra_curricular_activities ?></td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Languages Known</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;">
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
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <table style="width: 100%">
                                            <tr>
                                                <th style="line-height: 30px;"><strong>Driving License</strong></th>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;">
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
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="clearfix"></div>
                                        <div class="borderfull-width" style="border: solid 1px #e1e1e1;position: relative;overflow: hidden;margin: 12px 2px 15px 5px;"></div>
                                        <div class="page-heading">
                                            <h4>Uploded CV</h4>
                                            <div class="contact_details col-md-12 p-l">
                                                <?php
                                                if ($model->upload_resume != '') {
                                                    $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                                    if (file_exists($dirPath)) {
                                                        if ($model->upload_resume != '') {
                                                            if ($model->upload_resume == 'doc' || $model->upload_resume == 'docx') {
                                                                ?>
                                                                                                                                                                                                <!--<iframe src="https://docs.google.com/gview?url=<?= Yii::$app->homeUrl ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" frameborder="no" style="width:100%;height:300px"></iframe>-->
                                                                <iframe src="https://docs.google.com/viewer?embedded=true&url=<?= Yii::$app->homeUrl ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" frameborder="no" style="width:100%;height:300px"></iframe>
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
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
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


