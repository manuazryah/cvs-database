<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use common\components\ModalViewWidget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$course_datas = common\models\Courses::find()->where(['status' => 1])->all();
$country_datas = common\models\Country::find()->where(['status' => 1])->all();
?>
<style>
    .marg-bot-0 .form-group{
        margin-bottom: 0px;
    }
    .candidate_prof_add{
        background: white;
        padding: 0px;
        float: right;
        border-color: white;
        color: #067db1;
        font-weight: 500;
    }
    .candidate_prof_add:hover{
        color: #067db1;
    }
</style>
<div class="page_banner banner employer-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="banner-heading">Profile Edit</div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    echo ModalViewWidget::widget();
                    ?>
                    <?php
                    $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'panel-body register-form'
                                ]
                    ]);
                    ?>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'title')->textInput() ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <div class="col-md-6 p-l">
                            <?php
                            if ($model->photo != '') {
                                $label = 'Change Photo';
                            } else {
                                $label = 'Photo';
                            }
                            ?>
                            <?= $form->field($model, 'photo')->fileInput(['maxlength' => true])->label($label) ?>
                        </div>
                        <div class="col-md-6 p-r">
                            <?php
                            if ($model->photo != '') {
                                $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                if (file_exists($dirPath)) {
                                    echo '<img width="100px" height="100" style="float: right;" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                } else {
                                    echo '<img width="100px" height="100" style="float: right;" src="' . Yii::$app->homeUrl . 'images/user-5.jpg"/>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <div class="form-group col-md-6 p-l">
                            <?= $form->field($model, 'name')->textInput() ?>
                        </div>
                        <div class="form-group col-md-6 p-r" style="padding-top:34px;">
                            <?= $form->field($model, 'name_view')->checkbox(); ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?php $gender = ArrayHelper::map(\common\models\Gender::findAll(['status' => 1]), 'id', 'gender'); ?>
                        <?= $form->field($model, 'gender')->dropDownList($gender) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php
                        if (!isset($model->dob) && $model->dob != '') {
                            $model->dob = date('d-M-Y');
                        }
                        ?>
                        <?=
                        $form->field($model, 'dob')->widget(DatePicker::classname(), [
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'dd-M-yyyy'
                            ]
                        ])->label('DOB');
                        ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?php $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name'); ?>
                        <?= $form->field($model, 'nationality')->dropDownList($countries, ['prompt' => '-Choose a Nationality-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?= $form->field($model, 'current_country')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'current_city')->dropDownList(['prompt' => '-Choose a City-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php $salaty_ranges = ArrayHelper::map(common\models\ExpectedSalary::findAll(['status' => 1]), 'id', 'salary_range'); ?>
                        <?= $form->field($model, 'expected_salary')->dropDownList($salaty_ranges, ['prompt' => '-Choose expected salary-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?php $job_types = ArrayHelper::map(\common\models\JobType::findAll(['status' => 1]), 'id', 'job_type'); ?>
                        <?= $form->field($model, 'job_type')->dropDownList($job_types) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php $jobstatus = ArrayHelper::map(common\models\JobStatus::findAll(['status' => 1]), 'id', 'job_status'); ?>
                        <?= $form->field($model, 'job_status')->dropDownList($jobstatus, ['prompt' => '-Choose a Job Status-']) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'executive_summary')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r marg-bot-0">
                        <?php
                        $skills = [];
                        if (isset($model->industry) && $model->industry != '') {
                            $model->industry = explode(',', $model->industry);
                            $skills = ArrayHelper::map(\common\models\Skills::find()->where(['in', 'industry', $model->industry])->all(), 'id', 'skill');
                        }
                        ?>
                        <?php $industries = ArrayHelper::map(\common\models\Industry::find()->where(['status' => 1])->andWhere(['>', 'id', 0])->all(), 'id', 'industry_name'); ?>
                        <?= $form->field($model, 'industry')->dropDownList($industries, ['prompt' => 'Choose Industry', 'multiple' => 'multiple']) ?>
                        <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-industry'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?php
                        if (isset($model->skill) && $model->skill != '') {
                            $model->skill = explode(',', $model->skill);
                        }
                        ?>
                        <?= $form->field($model, 'skill')->dropDownList($skills, ['prompt' => 'Choose Skills', 'multiple' => 'multiple']) ?>
                        <?= Html::button('<span> Not in the list ? Request New</span>', ['value' => Url::to('../candidate/add-skill'), 'class' => 'btn btn-icon btn-white extra_btn candidate_prof_add modalButton']) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'extra_curricular_activities')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?php $languages = ArrayHelper::map(\common\models\Languages::findAll(['status' => 1]), 'id', 'language'); ?>
                        <?php
                        if (isset($model->languages_known) && $model->languages_known != '') {
                            $model->languages_known = explode(',', $model->languages_known);
                        }
                        ?>
                        <?= $form->field($model, 'languages_known')->dropDownList($languages, ['prompt' => '-Choose a Language-', 'multiple' => 'multiple']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php
                        if (isset($model->driving_licences) && $model->driving_licences != '') {
                            $model->driving_licences = explode(',', $model->driving_licences);
                        }
                        ?>
                        <?= $form->field($model, 'driving_licences')->dropDownList($countries, ['multiple' => 'multiple']) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'hobbies')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php // $form->field($model, 'total_experience')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="clearfix"></div>
                    <h4>Education - Academic</h4>
                    <hr class="appoint_history" />
                    <div id="p_scents">
                        <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">
                        <table class="table table-bordered order-list" id="myTable">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>College / University</th>
                                    <th>Country</th>
                                    <th>From Year</th>
                                    <th>To Year</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($model_education) && !$model->isNewRecord) {
                                    foreach ($model_education as $data) {
                                        if (!empty($data)) {
                                            ?>
                                            <tr id="edurow-<?= $data->id; ?>">
                                                <td>
                                                    <select class="form-control" name="updatee[<?= $data->id; ?>][course][]">
                                                        <option value="">Select Course</option>
                                                        <?php foreach ($course_datas as $course_data) { ?>
                                                            <option value="<?= $course_data->id ?>" <?= $data->course_name == $course_data->id ? 'selected' : '' ?>><?= $course_data->course_name ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][college][]" value="<?= $data->collage_university ?>">
                                                </td>
                                                <td>
                                                    <select class="form-control" name="updatee[<?= $data->id; ?>][country][]">
                                                        <option value="">Select Country</option>
                                                        <?php foreach ($country_datas as $country_data) { ?>
                                                            <option value="<?= $country_data->id ?>" <?= $data->country == $country_data->id ? 'selected' : '' ?>><?= $country_data->country_name ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="date" name="updatee[<?= $data->id; ?>][from_date][]" class="form-control" value="<?= $data->from_year ?>">
                                                </td>
                                                <td>
                                                    <input type="date" name="updatee[<?= $data->id; ?>][to_date][]" class="form-control" value="<?= $data->to_year ?>">
                                                </td>
                                                <td><a id="eduremove-<?= $data->id; ?>" class="eduremove"><i class="fa fa-remove"></i></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="create[course][]">
                                            <option value="">Select Course</option>
                                            <?php foreach ($course_datas as $course_data) { ?>
                                                <option value="<?= $course_data->id ?>"><?= $course_data->course_name ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="create[college][]">
                                    </td>
                                    <td>
                                        <select class="form-control" name="create[country][]">
                                            <option value="">Select Country</option>
                                            <?php foreach ($country_datas as $country_data) { ?>
                                                <option value="<?= $country_data->id ?>"><?= $country_data->country_name ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="create[from_date][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="date" name="create[to_date][]" class="form-control">
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                        <a id="addeducation" class="btn btn-icon btn-blue addScnt" ><i class="fa fa-plus"></i> Add More</a>
                    </div><br/>
                    <div class="clearfix"></div>
                    <h4>Work Experience</h4>
                    <hr class="appoint_history" />
                    <div id="p_experience">
                        <table class="table table-bordered experience-list" id="experienceTable">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Designation</th>
                                    <th>From Year</th>
                                    <th>To Year</th>
                                    <th>Job Responsibility</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                var_dump(count($model_experience));
//                                exit;
                                if (!empty($model_experience)) {
                                    foreach ($model_experience as $datas) {
                                        if ($datas) {
                                            ?>
                                            <tr id="exprow-<?= $datas->id; ?>">
                                                <td>
                                                    <input type="text" class="form-control" name="expupdatee[<?= $datas->id; ?>][company_name][]" value="<?= $datas->company_name ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="expupdatee[<?= $datas->id; ?>][designation][]" value="<?= $datas->designation ?>">
                                                </td>
                                                <td>
                                                    <input type="date" name="expupdatee[<?= $datas->id; ?>][from_date][]" class="form-control" value="<?= $datas->from_date ?>">
                                                </td>
                                                <td>
                                                    <input type="date" name="expupdatee[<?= $datas->id; ?>][to_date][]" class="form-control" value="<?= $datas->to_date ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="expupdatee[<?= $datas->id; ?>][job_responsibility][]" value="<?= $datas->job_responsibility ?>">
                                                </td>
                                                <td><a id="expremove-<?= $datas->id; ?>" class="expremove"><i class="fa fa-remove"></i></a></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="expcreate[company_name][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="expcreate[designation][]">
                                    </td>
                                    <td>
                                        <input type="date" name="expcreate[from_date][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="date" name="expcreate[to_date][]" class="form-control">
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="50" name="expcreate[job_responsibility][]"></textarea>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                        <a id="addexperience" class="btn btn-icon btn-blue addScnt" ><i class="fa fa-plus"></i> Add More</a>
                    </div><br/>
                    <div class="clearfix"></div>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-submit']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
</main>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>css/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#candidateprofile-industry").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#candidateprofile-skill").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
        $("#candidateprofile-driving_licences").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $("#candidateprofile-languages_known").select2({
            allowClear: true
        }).on('select2-open', function ()
        {
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

        $(document).on('change', '#candidateprofile-industry', function () {
            var industry = $(this).val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {industry: industry},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-skills',
                success: function (data) {
                    $('#candidateprofile-skill').html(data);
                }
            });
        });
        $(document).on('change', '#candidateprofile-current_country', function () {
            var country = $(this).val();
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {country: country},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-city',
                success: function (data) {
                    $('#candidateprofile-current_city').html(data);
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        var counter = 0;

        $("#addeducation").on("click", function () {

            var counter = $('#myTable tr').length - 2;

            $("#ibtnDel").on("click", function () {
                counter = -1
            });
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-acadamics',
                success: function (data) {
                    $("table.order-list").append(data);
                }
            });
            counter++;
        });

        $("table.order-list").on("click", "#ibtnDel", function (event) {
            $(this).closest("tr").remove();
        });

        $(document).on('click', '.eduremove', function () {
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-acadamics',
                success: function (data) {
                    if (data == 1) {
                        $('#edurow-' + current_row_id).remove();
                    }
                }
            });
        });


    });
</script>
<script>
    $(document).ready(function () {
        var counter = 0;

        $("#addexperience").on("click", function () {
            var counter = $('#experienceTable tr').length - 2;

            $("#ibtnDele").on("click", function () {
                counter = -1
            });
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {},
                url: '<?= Yii::$app->homeUrl ?>candidate/get-experience',
                success: function (data) {
                    $("table.experience-list").append(data);
                }
            });
            counter++;
        });

        $("table.experience-list").on("click", "#ibtnDele", function (event) {
            $(this).closest("tr").remove();
        });

        $(document).on('click', '.expremove', function () {
            var current_row_id = $(this).attr('id').match(/\d+/); // 123456
            $.ajax({
                type: 'POST',
                cache: false,
                async: false,
                data: {id: current_row_id},
                url: '<?= Yii::$app->homeUrl ?>candidate/remove-experience',
                success: function (data) {
                    if (data == 1) {
                        $('#exprow-' + current_row_id).remove();
                    }
                }
            });
        });
        $(document).on('click', '.modalButton', function () {

            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr("value"));
        });

    });
</script>
