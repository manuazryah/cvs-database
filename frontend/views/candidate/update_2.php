<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Country;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\helpers\Url;

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
                        <?= $form->field($model, 'dob')->textInput() ?>
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
                        <?=
                        AutoComplete::widget([
                            'model' => $model,
                            'attribute' => 'industry',
                            'options' => ['class' => 'form-control'],
                            'clientOptions' => [
                                'source' => Url::to(['candidate/industry-search']),
//                                'minLength' => '2',
                            ],
                        ]);
                        ?>
                        <?php // $form->field($model, 'industry')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="form-group col-md-12 p-l p-r">
                        <?= $form->field($model, 'skill')->textInput(['maxlength' => true]) ?>
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
                        <?= $form->field($model, 'driving_licences')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>
                    </div>
                    <div class="form-group col-md-6 p-r">
                        <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
                    </div>
                    <div class="clearfix"></div>
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-default']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>
</main>
