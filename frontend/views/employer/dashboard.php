<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search CVs';
$this->params['breadcrumbs'][] = $this->title;
$str = '';
$country_sort = common\models\Country::find()->orderBy(['country_name' => SORT_ASC])->all();
if (!empty($country_sort)) {
    foreach ($country_sort as $sort) {
        $str .= $sort->id . ',';
    }
}
if ($str != '') {
    $str = rtrim($str, ',');
}
$city_datas = ArrayHelper::map(\common\models\City::find()->orderBy([new \yii\db\Expression('FIELD (country, ' . $str . ')')])->all(), 'id', function($model) {
            return common\models\Country::findOne($model['country'])->country_name . ' - ' . $model['city'];
        }
);
?>
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 pad0 search-sec">
                <?= \common\widgets\Alert::widget() ?>
                <?php
                $form1 = ActiveForm::begin([
                            'method' => 'post',
                            'id' => 'filter-search',
                ]);
                ?>
                <div class="job-search">
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pad0">
                        <?= $form1->field($model_filter, 'keyword')->textInput(['placeholder' => 'Job title / keywords'])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 pad0">
                        <?= $form1->field($model_filter, 'location')->dropDownList($city_datas, ['multiple' => TRUE])->label(FALSE) ?>
                    </div>
                    <div class="col-lg-2 col-md-5 col-sm-5 col-xs-12 pad0">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-default fright']) ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="account-info">
                <div class="box">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-box-btm">
                        <div class="col-lg-4 brit"><p>Search Result : Total <span><?= $dataProvider->getTotalCount() ?> CVs</span> Found</p></div>
                        <div class="col-lg-8 pad0">
                            <div class="col-lg-7"><p class="color-white txt-center">You have <span><?= $user_plans->no_of_downloads_left ?> Credits</span> Remaining for CV Download</p></div>
                            <div class="col-lg-5 blft txt-right"><p>Your Credit Expiry on <span><?= date("d M Y", strtotime($user_plans->end_date)) ?></span></p></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="panel panel-default">
                <!-- Modal 6 (Long Modal)-->
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        </div>
                    </div>
                </div>

                <div class="panel-body">
                    <section class="mailbox-env">
                        <div class="">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box">
                                <h4 class="main-title">Refine your search</h4>
                                <div class="Left-nav">
                                    <div class="job_title">Industries</div>
                                    <div class="clearfix"></div>
                                    <div class="page-heading check-label">
                                        <input class="form-control" type="text" id="industryInput" onkeyup="industryFunction()" placeholder="Search for industries" title="Type Industry Name" autocomplete="off">
                                        <div class="search-scroll">
                                            <table id="industryTable">
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
                                                        <tr class="">
                                                            <td>
                                                                <label><input type="checkbox" <?= $check1 ?> name="CvFilter[industries][]" value="<?= $industry->id ?>"> <?= $industry->industry_name ?></label>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
//                                    echo $form1->field($model_filter, 'industries[]')->checkboxList($arr_industry, ['class' => 'check-label'])->label(FALSE);
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="job_title">Skills</div>
                                    <div class="page-heading check-label">
                                        <input class="form-control" type="text" id="skillInput" onkeyup="skillFunction()" placeholder="Search for skills" title="Type Skill" autocomplete="off">
                                        <div class="search-scroll">
                                            <table id="skillTable">
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
                                                        <tr class="">
                                                            <td>
                                                                <label><input type="checkbox" <?= $check2 ?> name="CvFilter[skills][]" value="<?= $skill->id ?>"> <?= $skill->skill ?></label>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
//                                    echo $form1->field($model_filter, 'skills[]')->checkboxList($arr_skill, ['class' => 'check-label'])->label(FALSE);
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="job_title">Job Type</div>
                                    <div class="page-heading check-label">
                                        <div class="search-noscroll">
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
                                    </div>
                                    <div class="job_title">Monthly Salary</div>
                                    <div class="page-heading check-label">
                                        <div class="search-scroll pad-tp">
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
                                    </div>
                                    <div class="job_title">Nationality</div>
                                    <div class="page-heading check-label">
                                        <input class="form-control" type="text" id="nationality" onkeyup="nationalityFunction()" placeholder="Search for nationality" title="Type Skill" autocomplete="off">
                                        <div class="search-scroll">
                                            <table id="nationalityTable">
                                                <?php
                                                $nationalities = common\models\Country::find()->where(['status' => 1])->all();
                                                $arr_nationality = [];
                                                if (!empty($nationalities)) {
                                                    foreach ($nationalities as $nationality) {
                                                        if ($model_filter->nationality != '' && isset($model_filter->nationality)) {
                                                            if (in_array($nationality->id, $model_filter->nationality)) {
                                                                $check4 = 'checked';
                                                            } else {
                                                                $check4 = '';
                                                            }
                                                        } else {
                                                            $check4 = '';
                                                        }
                                                        ?>
                                                        <tr class="">
                                                            <td>
                                                                <label><input type="checkbox" <?= $check4 ?> name="CvFilter[nationality][]" value="<?= $nationality->id ?>"> <?= $nationality->country_name ?></label>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="job_title">Experience</div>
                                    <div class="page-heading check-label">
                                        <div class="search-scroll pad-tp">
                                            <?php
                                            $experiences = \common\models\ExperienceSearch::find()->where(['status' => 1])->all();
                                            $arr_experiences = [];
                                            if (!empty($experiences)) {
                                                foreach ($experiences as $experience) {
                                                    if ($model_filter->experience != '' && isset($model_filter->experience)) {
                                                        if (in_array($experience->id, $model_filter->experience)) {
                                                            $check8 = 'checked';
                                                        } else {
                                                            $check8 = '';
                                                        }
                                                    } else {
                                                        $check8 = '';
                                                    }
                                                    ?>
                                                    <label><input type="checkbox" <?= $check8 ?> name="CvFilter[experience][]" value="<?= $experience->id ?>"> <?= $experience->experience_search ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="job_title">Gender</div>
                                    <div class="page-heading check-label">
                                        <div class="search-noscroll">
                                            <?php
                                            $genders = common\models\Gender::find()->where(['status' => 1])->all();
                                            $arr_sal = [];
                                            if (!empty($genders)) {
                                                foreach ($genders as $gender) {
                                                    if ($model_filter->gender != '' && isset($model_filter->gender)) {
                                                        if (in_array($gender->id, $model_filter->gender)) {
                                                            $check7 = 'checked';
                                                        } else {
                                                            $check7 = '';
                                                        }
                                                    } else {
                                                        $check7 = '';
                                                    }
                                                    ?>
                                                    <label><input type="checkbox" <?= $check7 ?> name="CvFilter[gender][]" value="<?= $gender->id ?>"> <?= $gender->gender ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="job_title">Languages</div>
                                    <div class="page-heading check-label">
                                        <div class="search-scroll pad-tp">
                                            <?php
                                            $languages = common\models\Languages::find()->where(['status' => 1])->all();
                                            $arr_sal = [];
                                            if (!empty($languages)) {
                                                foreach ($languages as $language) {
                                                    if ($model_filter->language != '' && isset($model_filter->language)) {
                                                        if (in_array($language->id, $model_filter->language)) {
                                                            $check5 = 'checked';
                                                        } else {
                                                            $check5 = '';
                                                        }
                                                    } else {
                                                        $check5 = '';
                                                    }
                                                    ?>
                                                    <label><input type="checkbox" <?= $check5 ?> name="CvFilter[language][]" value="<?= $language->id ?>"> <?= $language->language ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="job_title">Job Status</div>
                                    <div class="page-heading check-label">
                                        <div class="search-noscroll">
                                            <?php
                                            $job_status_datas = common\models\JobStatus::find()->where(['status' => 1])->all();
                                            $arr_sal = [];
                                            if (!empty($job_status_datas)) {
                                                foreach ($job_status_datas as $job_status_data) {
                                                    if ($model_filter->job_status != '' && isset($model_filter->job_status)) {
                                                        if (in_array($job_status_data->id, $model_filter->job_status)) {
                                                            $check6 = 'checked';
                                                        } else {
                                                            $check6 = '';
                                                        }
                                                    } else {
                                                        $check6 = '';
                                                    }
                                                    ?>
                                                    <label><input type="checkbox" <?= $check6 ?> name="CvFilter[job_status][]" value="<?= $job_status_data->id ?>"> <?= $job_status_data->job_status ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="job_title">Shortlist Folder</div>
                                    <div class="page-heading check-label">
                                        <div class="search-scroll pad-tp">
                                            <?php
                                            $folders = common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->groupBy('folder_name')->all();
                                            $arr_folder = [];
                                            if (!empty($folders)) {
                                                foreach ($folders as $folder) {
                                                    if ($model_filter->folder_name != '' && isset($model_filter->folder_name)) {
                                                        if (in_array($folder->folder_name, $model_filter->folder_name)) {
                                                            $check8 = 'checked';
                                                        } else {
                                                            $check8 = '';
                                                        }
                                                    } else {
                                                        $check8 = '';
                                                    }
                                                    ?>
                                                    <label><input type="checkbox" <?= $check8 ?> name="CvFilter[folder_name][]" value="<?= $folder->folder_name ?>"> <?= $folder->folder_name ?></label>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php // Html::submitButton('Search', ['class' => 'btn btn-default'])        ?>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 prit0">
                                <div class="col-md-9 col-sm-9 p-l">
                                    <div class="page-heading mb0" style="padding: 10px 0px; padding-bottom: 10px;">
                                        <?php
                                        $your_search_filter = '';
                                        if (isset($model_filter->keyword) && $model_filter->keyword != '') {
                                            $your_search_filter .= '"' . $model_filter->keyword . '", ';
                                        }
                                        if (isset($model_filter->location) && $model_filter->location != '') {
                                            foreach ($model_filter->location as $value) {
                                                $city = common\models\City::find()->where(['id' => $value])->one();
                                                if (!empty($city)) {
                                                    $country = \common\models\Country::find()->where(['id' => $city->country])->one();
                                                    if (!empty($country)) {
                                                        $your_search_filter .= '"' . $city->city . ' - ' . $country->country_name . '", ';
                                                    } else {
                                                        $your_search_filter .= '"' . $city->city . '", ';
                                                    }
                                                }
                                            }
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
                                        if (isset($model_filter->salary_range) && $model_filter->salary_range != '') {
                                            foreach ($model_filter->salary_range as $salary_range_value) {
                                                $your_search_filter .= '"' . common\models\ExpectedSalary::findOne($salary_range_value)->salary_range . '", ';
                                            }
                                        }
                                        if (isset($model_filter->nationality) && $model_filter->nationality != '') {
                                            foreach ($model_filter->nationality as $nationality_value) {
                                                $your_search_filter .= '"' . common\models\Country::findOne($nationality_value)->country_name . '", ';
                                            }
                                        }
                                        if (isset($model_filter->experience) && $model_filter->experience != '') {
                                            foreach ($model_filter->experience as $experience_value) {
                                                $your_search_filter .= '"' . common\models\ExperienceSearch::findOne($experience_value)->experience_search . '", ';
                                            }
                                        }
                                        if (isset($model_filter->gender) && $model_filter->gender != '') {
                                            foreach ($model_filter->gender as $gender_value) {
                                                $your_search_filter .= '"' . common\models\Gender::findOne($gender_value)->gender . '", ';
                                            }
                                        }
                                        if (isset($model_filter->language) && $model_filter->language != '') {
                                            foreach ($model_filter->language as $language_value) {
                                                $your_search_filter .= '"' . common\models\Languages::findOne($language_value)->language . '", ';
                                            }
                                        }
                                        if (isset($model_filter->job_status) && $model_filter->job_status != '') {
                                            foreach ($model_filter->job_status as $job_status_value) {
                                                $your_search_filter .= '"' . common\models\JobStatus::findOne($job_status_value)->job_status . '", ';
                                            }
                                        }
                                        if (isset($model_filter->folder_name) && $model_filter->folder_name != '') {
                                            foreach ($model_filter->folder_name as $folder_name_value) {
                                                $your_search_filter .= '"' . $folder_name_value . '", ';
                                            }
                                        }
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
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<input type="hidden" class="login_session" value="<?= Yii::$app->session['login-session'] ?>">
<div id="employer_detail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Welcome to www.cvsdatabase.com</h4>
            </div>
            <div class="modal-body">
                <p>Your Credit Details</p>
                <table class="table">
                    <tr>
                        <td>Credits Remaining</td>
                        <td>:</td>
                        <td><?= $user_plans->no_of_downloads_left ?></td>
                    </tr>
                    <tr>
                        <td>Valid Until</td>
                        <td>:</td>
                        <td><?= date('Y-M-d', strtotime($user_plans->end_date)); ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
    $(window).on('load', function () {
        if ($('.login_session').val() === "open") {
            $('#employer_detail').modal('show');
        }
    });
</script>
<?php Yii::$app->session['login-session'] = 'close' ?>
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
    function industryFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("industryInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("industryTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function skillFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("skillInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("skillTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function nationalityFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("nationality");
        filter = input.value.toUpperCase();
        table = document.getElementById("nationalityTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#cvfilter-location").select2({
            placeholder: 'Choose Country / City',
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

    });
</script>


