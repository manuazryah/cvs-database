<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Featured CVs';
$this->params['breadcrumbs'][] = $this->title;
$countries = common\models\Country::find()->all();
$cities = common\models\City::find()->all();
?>
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <!-- Modal 6 (Long Modal)-->
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?php
                    $form1 = ActiveForm::begin([
                                'method' => 'post',
                                'id' => 'filter-search',
                    ]);
                    ?>
                    <section class="mailbox-env">
                        <div class="row">
                            <div class="box">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="job-search">
                                        <?= $form1->field($model_filter, 'keyword')->textInput(['placeholder' => 'Job title / keywords'])->label(FALSE) ?>
                                        <div class="form-group field-cvfilter-location">
                                            <label class="control-label" for="cvfilter-location">Location</label>
                                            <select id="cvfilter-location" class="form-control" name="CvFilter[location]" multiple="multiple">
                                                <option value="">-Choose Country / City-</option>
                                                <?php
                                                if (!empty($countries)) {
                                                    foreach ($countries as $country) {
                                                        ?>
                                                        <option value="<?= $country->country_name ?>"><?= $country->country_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                if (!empty($cities)) {
                                                    foreach ($cities as $city) {
                                                        ?>
                                                        <option value="<?= $city->city ?>"><?= $city->city ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                        <?php // $form1->field($model_filter, 'location')->textInput(['placeholder' => 'Country / City'])->label(FALSE)  ?>
                                        <?= Html::submitButton('Search', ['class' => 'btn btn-default']) ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-lg-6 f-right">
                                        <div class="support-info">
                                            <p><strong>For Support Call Us / Whatsapp</strong></p>
                                            <p><i class="fa fa-phone"></i>+971 50 4752515</p>
                                            <p><i class="fa fa-clock-o"></i>UAE Time: 8AM - 8PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 btop ptop5 pbtm5 shortlist-f-link">
                                    <div class="col-lg-4 pad0 f-right">
                                        <?= Html::a('See Shortlisted CVs/ Folders<i class="fa fa-shortlist"></i>', ['shortlist-folder'], ['target' => '_blank']) ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="box ptop5">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-box-btm">
                                    <div class="col-lg-4 brit"><p>Search Result : <span>Total <?= $dataProvider->getTotalCount() ?> CVs Found</span></p></div>
                                    <div class="col-lg-8 pad0">
                                        <div class="col-lg-7"><p class="color-drk txt-center">You have <?= $user_plans->no_of_downloads_left ?>/<?= $user_plans->no_of_downloads ?> Credits for CV Download</p></div>
                                        <div class="col-lg-5 blft txt-right"><p>Your Credit Expiry on <?= date("d M Y", strtotime($user_plans->end_date)) ?></p></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box">
                                <div class="job_title">Industries</div>
                                <div class="borderfull-width"></div>
                                <div class="clearfix"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $industries = common\models\Industry::find()->where(['status' => 1])->andWhere(['<>', 'id', 0])->all();
                                    $arr_industry = [];
                                    if (!empty($industries)) {
//                                        foreach ($industries as $industry) {
//                                            $arr_industry[$industry['id']] = $industry['industry_name'];
//                                        }
                                        foreach ($industries as $industry) {
                                            if ($model_filter->industries != '' && isset($model_filter->industries)) {
                                                if (in_array($industry->id, $model_filter->industries)) {
                                                    $check1 = 'checked';
                                                } else {
                                                    $check1 = '';
                                                }
                                            } else {
                                                $check1 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check1 ?> name="CvFilter[industries][]" value="<?= $industry->id ?>"> <?= $industry->industry_name ?></label>
                                            <?php
                                        }
                                    }
//                                    echo $form1->field($model_filter, 'industries[]')->checkboxList($arr_industry, ['class' => 'check-label'])->label(FALSE);
                                    ?>
                                </div>
                                <div class="job_title">Skills</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $skills = common\models\Skills::find()->where(['status' => 1])->andWhere(['<>', 'industry', 0])->all();
                                    $arr_skill = [];
                                    if (!empty($skills)) {
//                                        foreach ($skills as $skill) {
//                                            $arr_skill[$skill['id']] = $skill['skill'];
//                                        }
                                        foreach ($skills as $skill) {
                                            if ($model_filter->skills != '' && isset($model_filter->skills)) {
                                                if (in_array($skill->id, $model_filter->skills)) {
                                                    $check2 = 'checked';
                                                } else {
                                                    $check2 = '';
                                                }
                                            } else {
                                                $check2 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check2 ?> name="CvFilter[skills][]" value="<?= $skill->id ?>"> <?= $skill->skill ?></label>
                                            <?php
                                        }
                                    }
//                                    echo $form1->field($model_filter, 'skills[]')->checkboxList($arr_skill, ['class' => 'check-label'])->label(FALSE);
                                    ?>
                                </div>
                                <div class="job_title">Job Type</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $job_categories = common\models\JobType::find()->where(['status' => 1])->all();
                                    $arr_job = [];
                                    if (!empty($job_categories)) {
                                        foreach ($job_categories as $job_category) {
                                            if ($model_filter->job_types != '' && isset($model_filter->job_types)) {
                                                if (in_array($job_category->id, $model_filter->job_types)) {
                                                    $check2 = 'checked';
                                                } else {
                                                    $check2 = '';
                                                }
                                            } else {
                                                $check2 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check2 ?> name="CvFilter[job_types][]" value="<?= $job_category->id ?>"> <?= $job_category->job_type ?></label>
                                            <?php
                                        }
                                    }
//                                    echo $form1->field($model_filter, 'job_types[]')->checkboxList($arr_job, ['class' => 'check-label'])->label(FALSE);
                                    ?>
                                </div>
                                <div class="job_title">Monthly Salary</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $salary_ranges = common\models\ExpectedSalary::find()->where(['status' => 1])->all();
                                    $arr_sal = [];
                                    if (!empty($salary_ranges)) {
                                        foreach ($salary_ranges as $salary_range) {
                                            if ($model_filter->salary_range != '' && isset($model_filter->salary_range)) {
                                                if (in_array($salary_range->id, $model_filter->salary_range)) {
                                                    $check3 = 'checked';
                                                } else {
                                                    $check3 = '';
                                                }
                                            } else {
                                                $check3 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check3 ?> name="CvFilter[salary_range][]" value="<?= $salary_range->id ?>"> <?= $salary_range->salary_range ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="job_title">Gender</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $genders = common\models\Gender::find()->where(['status' => 1])->all();
                                    $arr_sal = [];
                                    if (!empty($genders)) {
                                        foreach ($genders as $gender) {
                                            if ($model_filter->gender != '' && isset($model_filter->gender)) {
                                                if (in_array($gender->id, $model_filter->gender)) {
                                                    $check4 = 'checked';
                                                } else {
                                                    $check4 = '';
                                                }
                                            } else {
                                                $check4 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check4 ?> name="CvFilter[gender][]" value="<?= $gender->id ?>"> <?= $gender->gender ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="job_title">Languages</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $languages = common\models\Languages::find()->where(['status' => 1])->all();
                                    $arr_sal = [];
                                    if (!empty($languages)) {
                                        foreach ($languages as $language) {
                                            if ($model_filter->language != '' && isset($model_filter->language)) {
                                                if (in_array($language->id, $model_filter->language)) {
                                                    $check4 = 'checked';
                                                } else {
                                                    $check4 = '';
                                                }
                                            } else {
                                                $check4 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check4 ?> name="CvFilter[language][]" value="<?= $language->id ?>"> <?= $language->language ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="job_title">Job Status</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading check-label">
                                    <?php
                                    $job_status_datas = common\models\JobStatus::find()->where(['status' => 1])->all();
                                    $arr_sal = [];
                                    if (!empty($job_status_datas)) {
                                        foreach ($job_status_datas as $job_status_data) {
                                            if ($model_filter->job_status != '' && isset($model_filter->job_status)) {
                                                if (in_array($job_status_data->id, $model_filter->job_status)) {
                                                    $check5 = 'checked';
                                                } else {
                                                    $check5 = '';
                                                }
                                            } else {
                                                $check5 = '';
                                            }
                                            ?>
                                            <label><input type="checkbox" <?= $check5 ?> name="CvFilter[job_status][]" value="<?= $job_status_data->id ?>"> <?= $job_status_data->job_status ?></label>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php // Html::submitButton('Search', ['class' => 'btn btn-default'])    ?>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 prit0">
                                <div class="col-md-12 col-sm-12 p-l">
                                    <div class="page-heading">
                                        <?php
                                        $your_search_filter = '';
                                        if (isset($model_filter->keyword) && $model_filter->keyword != '') {
                                            $your_search_filter .= '"' . $model_filter->keyword . '", ';
                                        }
                                        if (isset($model_filter->location) && $model_filter->location != '') {
                                            $your_search_filter .= '"' . $model_filter->location . '", ';
                                        }
                                        if (isset($model_filter->industries) && $model_filter->industries != '') {
                                            foreach ($model_filter->industries as $indus_value) {
                                                $your_search_filter .= '"' . common\models\Industry::findOne($indus_value)->industry_name . '", ';
                                            }
                                        }
                                        if (isset($model_filter->skills) && $model_filter->skills != '') {
                                            foreach ($model_filter->skills as $skills_value) {
                                                $your_search_filter .= '"' . common\models\Skills::findOne($skills_value)->skill . '", ';
                                            }
                                        }
                                        if (isset($model_filter->job_types) && $model_filter->job_types != '') {
                                            foreach ($model_filter->job_types as $job_type_value) {
                                                $your_search_filter .= '"' . common\models\JobType::findOne($job_type_value)->job_type . '", ';
                                            }
                                        }
//                                        if ($your_search_filter != '') {
//                                            $your_search_filter = rtrim($your_search_filter, ',');
//                                        }
                                        ?>
                                        <p><span class="color-drk">Your Search Filter</span>: <?= $your_search_filter ?></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="page_listing candidate">
                                    <?php
                                    echo ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemView' => '_item',
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input[type="checkbox"]').change(function () {
            $("#filter-search").submit();
        });
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
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>dash/css/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>dash/css/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>dash/js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#cvfilter-location").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>

