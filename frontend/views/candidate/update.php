<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = 'Update Candidate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main id="maincontent">
    <section class="resume">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'panel-body register-form'
                                ]
                    ]);
                    ?>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'title')->textInput() ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'name')->textInput() ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php $gender = ArrayHelper::map(\common\models\Gender::findAll(['status' => 1]), 'id', 'gender'); ?>
                        <?= $form->field($model, 'gender')->dropDownList($gender) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
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
                    <div class="form-group col-md-6 p-r">
                        <?php $countries = ArrayHelper::map(Country::findAll(['status' => 1]), 'id', 'country_name'); ?>
                        <?= $form->field($model, 'nationality')->dropDownList($countries, ['prompt' => '-Choose a Nationality-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'current_country')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?= $form->field($model, 'current_city')->dropDownList(['prompt' => '-Choose a City-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'expected_salary')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php $job_types = ArrayHelper::map(\common\models\JobType::findAll(['status' => 1]), 'id', 'job_type'); ?>
                        <?= $form->field($model, 'job_type')->dropDownList($job_types) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'job_status')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'executive_summary')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?php
                        $skills = [];
                        if (isset($model->industry) && $model->industry != '') {
                            $model->industry = explode(',', $model->industry);
                            $skills = ArrayHelper::map(\common\models\Skills::find()->where(['in', 'industry', $model->industry])->all(), 'id', 'skill');
                        }
                        ?>
                        <?php $industries = ArrayHelper::map(\common\models\Industry::findAll(['status' => 1]), 'id', 'industry_name'); ?>
                        <?= $form->field($model, 'industry')->dropDownList($industries, ['prompt' => 'Choose Industry', 'multiple' => 'multiple']) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?php
                        if (isset($model->skill) && $model->skill != '') {
                            $model->skill = explode(',', $model->skill);
                        }
                        ?>
                        <?= $form->field($model, 'skill')->dropDownList($skills, ['prompt' => 'Choose Skills', 'multiple' => 'multiple']) ?>
                        <?php // $form->field($model, 'skill')->dropDownList(['prompt' => 'Choose Skill'], ['multiple' => 'multiple'])  ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'extra_curricular_activities')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?= $form->field($model, 'hobbies')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?php $languages = ArrayHelper::map(\common\models\Languages::findAll(['status' => 1]), 'id', 'language'); ?>
                        <?= $form->field($model, 'languages_known')->dropDownList($languages) ?>
                    </div>
                    <div class="form-group col-md-6 p-l">
                        <?php
                        if (isset($model->driving_licences) && $model->driving_licences != '') {
                            $model->driving_licences = explode(',', $model->driving_licences);
                        }
                        ?>
                        <?= $form->field($model, 'driving_licences')->dropDownList($countries, ['prompt' => '-Choose a Country-', 'multiple' => 'multiple']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
                    </div>
                    <div class="clearfix"></div>
                    <h4>Education - Academic</h4>
                    <hr class="appoint_history" />
                    <div id="p_scents">
                        <input type="hidden" id="delete_port_vals"  name="delete_port_vals" value="">
                        <table class="table table-bordered">
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
                                if (!empty($model_education)) {

                                    foreach ($model_education as $data) {
                                        ?>
                                    <span>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="updatee[<?= $data->id; ?>][label][]" value="<?= $data->label; ?>" required>
                                            </td>
                                            <td><a id="remScnt" val="<?= $data->id; ?>" class="btn btn-icon btn-red remScnt" ><i class="fa-remove"></i></a></td>
                                        </tr>
                                    </span>
                                    <?php
                                }
                            }
                            ?>
                            <span>
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="create[label][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="create[label][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="create[label][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="create[label][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="create[label][]">
                                    </td>
                                    <td></td>
                                </tr>
                            </span>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="form-group field-portcalldatarob-fresh_water_arrival_quantity">
                        <a id="addScnt" class="btn btn-icon btn-blue addScnt" ><i class="fa fa-plus"></i> Add Education</a>
                    </div><br/>
                    <hr class="appoint_history" />
                    <div class="clearfix"></div>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-default']) ?>
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
        /*
         * Add more bnutton function
         */
        var scntDiv = $('#p_scents');
        var i = $('#p_scents span').size() + 1;
        $('#addScnt').on('click', function () {
            var ver = '<span>\n\
                                <div class="form-group">\n\
                                <label class="control-label" for=""></label>\n\
                                <input type="text" id="" class="form-control" name="create[label][]" required>\n\
                                </div> \n\
                                <div class="form-group">\n\
                                <label class="control-label" for=""></label>\n\
                                <input type="text" class="form-control" name="create[valuee][]" required>\n\
                                </div> \n\
                                <div class="form-group ">\n\
                                <label class="control-label"></label>\n\
                                <input type="text" id="" class="form-control" name="create[comment][]" required>\n\
                                </div>\n\
                                <div class="form-group">\n\
                                <a id="remScnt" class="btn btn-icon btn-red remScnt" ><i class="fa-remove"></i></a>\n\
                                 </div><br/>\n\
                                </span>';
            $(ver).appendTo(scntDiv);
            i++;
            return false;
        });
        $('#p_scents').on('click', '.remScnt', function () {
            if (i > 2) {
                $(this).parents('span').remove();
                i--;
            }
            if (this.hasAttribute("val")) {
                var valu = $(this).attr('val');
                $('#delete_port_vals').val($('#delete_port_vals').val() + valu + ',');
                var value = $('#delete_port_vals').val();
            }
            return false;
        });
    });
</script>
