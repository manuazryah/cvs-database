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
$useragent = $_SERVER['HTTP_USER_AGENT'];
?>
<style>
    .summary{
        display: none;
    }
</style>
<div class="cv-search-result admin-users-index">
    <div class="">
        <div class="col-md-12">

            <div class="panel panel-default">
                <!-- Modal 6 (Long Modal)-->
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?php
                    $form1 = ActiveForm::begin([
                                'method' => 'post',
                                'id' => 'filter-search',
                    ]);
                    ?>
                    <div class="">
                        <div class="box">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pad0 search-sec mtop60">
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
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pad0">
                                        <?= Html::submitButton('Search', ['class' => 'btn btn-default fright']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="search-filter-summery">
                                <h3 class="panel-title">Search Result : Total <span>&nbsp;&nbsp;<?= $dataProvider->getTotalCount() > 0 ? $dataProvider->getTotalCount() : 'No' ?> Cvs&nbsp;&nbsp;</span>  Found</h3>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="panel panel-default">
                        <section class="mailbox-env">
                            <div class="box search-mobile-view">
                                <div class="filter-head">
                                    <h4 data-toggle="modal" data-target="#exampleModalLong" class="main-title">Refine your search <i class="fa fa fa-plus"></i></h4>
                                </div>
                                <!-- Modal -->
                                <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-backdrop in"></div>
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="button-header">
                                                <button type="button" class="close-button" data-dismiss="modal" aria-label="Close"><i class="fa fa fa-close"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo">Industries <span class="right-span">+</span></div>

                                                    <div id="demo" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <input class="form-control" type="text" id="industryInput1" onkeyup="industryFunction()1" placeholder="Search for industries" title="Type Industry Name" autocomplete="off">
                                                            <div class="search-scroll">
                                                                <table id="industryTable1">
                                                                    <?php
                                                                    $industries = common\models\Industry::find()->where(['status' => 1])->andWhere(['<>', 'id', 0])->all();
                                                                    $arr_industry = [];
                                                                    if (!empty($industries)) {
//                                        foreach ($industries as $industry) {
//                                            $arr_industry[$industry['id']] = $industry['industry_name'];
//                                        }
                                                                        foreach ($industries as $industry) {
                                                                            if ($model_filter->industries1 != '' && isset($model_filter->industries1)) {
                                                                                if (in_array($industry->id, $model_filter->industries1)) {
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
                                                                                    <label><input type="checkbox" <?= $check1 ?> name="CvFilter[industries1][]" value="<?= $industry->id ?>"> <?= $industry->industry_name ?></label>
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
                                                    </div>
                                                </div>

                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo2">Skills <span class="right-span">+</span></div>

                                                    <div id="demo2" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <input class="form-control" type="text" id="skillInput1" onkeyup="skillFunction1()" placeholder="Search for skills" title="Type Skill" autocomplete="off">
                                                            <div class="search-scroll">
                                                                <table id="skillTable1">
                                                                    <?php
                                                                    $skills = common\models\Skills::find()->where(['status' => 1])->all();
                                                                    $arr_skill = [];
                                                                    if (!empty($skills)) {
//                                        foreach ($skills as $skill) {
//                                            $arr_skill[$skill['id']] = $skill['skill'];
//                                        }
                                                                        foreach ($skills as $skill) {
                                                                            if ($model_filter->skills1 != '' && isset($model_filter->skills1)) {
                                                                                if (in_array($skill->id, $model_filter->skills1)) {
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
                                                                                    <label><input type="checkbox" <?= $check2 ?> name="CvFilter[skills1][]" value="<?= $skill->id ?>"> <?= $skill->skill ?></label>
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
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo3">Job Type <span class="right-span">+</span></div>

                                                    <div id="demo3" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-noscroll">
                                                                <?php
                                                                $job_categories = common\models\JobType::find()->where(['status' => 1])->all();
                                                                $arr_job = [];
                                                                if (!empty($job_categories)) {
                                                                    foreach ($job_categories as $job_category) {
                                                                        if ($model_filter->job_types1 != '' && isset($model_filter->job_types1)) {
                                                                            if (in_array($job_category->id, $model_filter->job_types1)) {
                                                                                $check2 = 'checked';
                                                                            } else {
                                                                                $check2 = '';
                                                                            }
                                                                        } else {
                                                                            $check2 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check2 ?> name="CvFilter[job_types1][]" value="<?= $job_category->id ?>"> <?= $job_category->job_type ?></label>
                                                                        <?php
                                                                    }
                                                                }
//                                    echo $form1->field($model_filter, 'job_types[]')->checkboxList($arr_job, ['class' => 'check-label'])->label(FALSE);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo4">Monthly Salary <span class="right-span">+</span></div>

                                                    <div id="demo4" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-scroll pad-tp">
                                                                <?php
                                                                $salary_ranges = common\models\ExpectedSalary::find()->where(['status' => 1])->all();
                                                                $arr_sal = [];
                                                                if (!empty($salary_ranges)) {
                                                                    foreach ($salary_ranges as $salary_range) {
                                                                        if ($model_filter->salary_range1 != '' && isset($model_filter->salary_range1)) {
                                                                            if (in_array($salary_range->id, $model_filter->salary_range1)) {
                                                                                $check3 = 'checked';
                                                                            } else {
                                                                                $check3 = '';
                                                                            }
                                                                        } else {
                                                                            $check3 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check3 ?> name="CvFilter[salary_range1][]" value="<?= $salary_range->id ?>"> <?= $salary_range->salary_range ?></label>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo5">Nationality <span class="right-span">+</span></div>

                                                    <div id="demo5" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <input class="form-control" type="text" id="nationality1" onkeyup="nationalityFunction1()" placeholder="Search for nationality" title="Type Skill" autocomplete="off">
                                                            <div class="search-scroll">
                                                                <table id="nationalityTable1">
                                                                    <?php
                                                                    $nationalities = common\models\Country::find()->where(['status' => 1])->all();
                                                                    $arr_nationality = [];
                                                                    if (!empty($nationalities)) {
                                                                        foreach ($nationalities as $nationality) {
                                                                            if ($model_filter->nationality1 != '' && isset($model_filter->nationality1)) {
                                                                                if (in_array($nationality->id, $model_filter->nationality1)) {
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
                                                                                    <label><input type="checkbox" <?= $check4 ?> name="CvFilter[nationality1][]" value="<?= $nationality->id ?>"> <?= $nationality->country_name ?></label>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo6">Experience <span class="right-span">+</span></div>

                                                    <div id="demo6" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-scroll pad-tp">
                                                                <?php
                                                                $experiences = \common\models\ExperienceSearch::find()->where(['status' => 1])->all();
                                                                $arr_experiences = [];
                                                                if (!empty($experiences)) {
                                                                    foreach ($experiences as $experience) {
                                                                        if ($model_filter->experience1 != '' && isset($model_filter->experience1)) {
                                                                            if (in_array($experience->id, $model_filter->experience1)) {
                                                                                $check8 = 'checked';
                                                                            } else {
                                                                                $check8 = '';
                                                                            }
                                                                        } else {
                                                                            $check8 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check8 ?> name="CvFilter[experience1][]" value="<?= $experience->id ?>"> <?= $experience->experience_search ?></label>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo7">Gender <span class="right-span">+</span></div>

                                                    <div id="demo7" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-noscroll">
                                                                <?php
                                                                $genders = common\models\Gender::find()->where(['status' => 1])->all();
                                                                $arr_sal = [];
                                                                if (!empty($genders)) {
                                                                    foreach ($genders as $gender) {
                                                                        if ($model_filter->gender1 != '' && isset($model_filter->gender1)) {
                                                                            if (in_array($gender->id, $model_filter->gender1)) {
                                                                                $check7 = 'checked';
                                                                            } else {
                                                                                $check7 = '';
                                                                            }
                                                                        } else {
                                                                            $check7 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check7 ?> name="CvFilter[gender1][]" value="<?= $gender->id ?>"> <?= $gender->gender ?></label>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo8">Languages <span class="right-span">+</span></div>

                                                    <div id="demo8" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-scroll pad-tp">
                                                                <?php
                                                                $languages = common\models\Languages::find()->where(['status' => 1])->all();
                                                                $arr_sal = [];
                                                                if (!empty($languages)) {
                                                                    foreach ($languages as $language) {
                                                                        if ($model_filter->language1 != '' && isset($model_filter->language1)) {
                                                                            if (in_array($language->id, $model_filter->language1)) {
                                                                                $check5 = 'checked';
                                                                            } else {
                                                                                $check5 = '';
                                                                            }
                                                                        } else {
                                                                            $check5 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check5 ?> name="CvFilter[language1][]" value="<?= $language->id ?>"> <?= $language->language ?></label>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="filter-mobile-box"><!--filter-mobile-box-->
                                                    <div id="button" type="button" class="filter-list-button job_title" data-toggle="collapse" data-target="#demo9">Job Status <span class="right-span">+</span></div>

                                                    <div id="demo9" class="collapse categories-filter" val='button'>
                                                        <div class="page-heading check-label">
                                                            <div class="search-noscroll">
                                                                <?php
                                                                $job_status_datas = common\models\JobStatus::find()->where(['status' => 1])->all();
                                                                $arr_sal = [];
                                                                if (!empty($job_status_datas)) {
                                                                    foreach ($job_status_datas as $job_status_data) {
                                                                        if ($model_filter->job_status1 != '' && isset($model_filter->job_status1)) {
                                                                            if (in_array($job_status_data->id, $model_filter->job_status1)) {
                                                                                $check6 = 'checked';
                                                                            } else {
                                                                                $check6 = '';
                                                                            }
                                                                        } else {
                                                                            $check6 = '';
                                                                        }
                                                                        ?>
                                                                        <label><input type="checkbox" <?= $check6 ?> name="CvFilter[job_status1][]" value="<?= $job_status_data->id ?>"> <?= $job_status_data->job_status ?></label>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <div class="">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box search-desktop-view">
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
                                                    $skills = common\models\Skills::find()->where(['status' => 1])->all();
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
                                    </div>
                                </div>
                                <?php // Html::submitButton('Search', ['class' => 'btn btn-default'])        ?>
                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 prit0">
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
                                            if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
                                                if (isset($model_filter->industries1) && $model_filter->industries1 != '') {
                                                    foreach ($model_filter->industries1 as $indus_value) {
                                                        $your_search_filter .= '"' . common\models\Industry::findOne($indus_value)->industry_name . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->skills1) && $model_filter->skills1 != '') {
                                                    foreach ($model_filter->skills1 as $skills_value) {
                                                        $your_search_filter .= '"' . common\models\Skills::findOne($skills_value)->skill . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->job_types1) && $model_filter->job_types1 != '') {
                                                    foreach ($model_filter->job_types1 as $job_type_value) {
                                                        $your_search_filter .= '"' . common\models\JobType::findOne($job_type_value)->job_type . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->salary_range1) && $model_filter->salary_range1 != '') {
                                                    foreach ($model_filter->salary_range1 as $salary_range_value) {
                                                        $your_search_filter .= '"' . common\models\ExpectedSalary::findOne($salary_range_value)->salary_range . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->nationality1) && $model_filter->nationality1 != '') {
                                                    foreach ($model_filter->nationality1 as $nationality_value) {
                                                        $your_search_filter .= '"' . common\models\Country::findOne($nationality_value)->country_name . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->experience1) && $model_filter->experience1 != '') {
                                                    foreach ($model_filter->experience1 as $experience_value) {
                                                        $your_search_filter .= '"' . common\models\ExperienceSearch::findOne($experience_value)->experience_search . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->gender1) && $model_filter->gender1 != '') {
                                                    foreach ($model_filter->gender1 as $gender_value) {
                                                        $your_search_filter .= '"' . common\models\Gender::findOne($gender_value)->gender . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->language1) && $model_filter->language1 != '') {
                                                    foreach ($model_filter->language1 as $language_value) {
                                                        $your_search_filter .= '"' . common\models\Languages::findOne($language_value)->language . '", ';
                                                    }
                                                }
                                                if (isset($model_filter->job_status1) && $model_filter->job_status1 != '') {
                                                    foreach ($model_filter->job_status1 as $job_status_value) {
                                                        $your_search_filter .= '"' . common\models\JobStatus::findOne($job_status_value)->job_status . '", ';
                                                    }
                                                }
                                            } else {
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
                                            'itemView' => '_item_search',
                                            'pager' => [
                                                'options' => ['class' => 'pagination'],
                                                'prevPageLabel' => '<', // Set the label for the "previous" page button
                                                'nextPageLabel' => '>', // Set the label for the "next" page button
                                                'firstPageLabel' => '<<', // Set the label for the "first" page button
                                                'lastPageLabel' => '>>', // Set the label for the "last" page button
                                                'nextPageCssClass' => '>', // Set CSS class for the "next" page button
                                                'prevPageCssClass' => '<', // Set CSS class for the "previous" page button
                                                'firstPageCssClass' => '<<', // Set CSS class for the "first" page button
                                                'lastPageCssClass' => '>>', // Set CSS class for the "last" page button
                                                'maxButtonCount' => 5, // Set maximum number of page buttons that can be displayed
                                            ],
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="returnModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <p><?= Html::a('<button type="button" class="btn btn-primary">Log in</button>', ['employer/index']) ?> to read the CV</p>
            </div>
        </div>

    </div>
</div>
<script>
    $('.myBtn').on('click', function () {
        $('#returnModal').modal('toggle');
    });
</script>
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
    function industryFunction1() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("industryInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("industryTable1");
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
    function skillFunction1() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("skillInput1");
        filter = input.value.toUpperCase();
        table = document.getElementById("skillTable1");
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
    function nationalityFunction1() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("nationality1");
        filter = input.value.toUpperCase();
        table = document.getElementById("nationalityTable1");
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
            allowClear: true,
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

    });
</script>


