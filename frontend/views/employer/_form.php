<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Employer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employer-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= \common\widgets\Alert::widget() ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly' => TRUE]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <?= $form->field($model, 'address')->textarea(['class' => 'form-control']) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?php $countries = ArrayHelper::map(\common\models\Country::findAll(['status' => 1]), 'id', 'country_name'); ?>
            <?= $form->field($model, 'country')->dropDownList($countries, ['prompt' => '-Choose a Country-']) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-3 col-sm-6 col-xs-12'>
            <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <?= $form->field($model, 'description')->textarea(['rows' => '6']) ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-4 col-xs-12'>
            <?= $form->field($model, 'company_phone_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4 col-sm-4 col-xs-12'>
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <!--<button type="submit" class="btn btn-larger btn-block submit">Submit</button>-->
        <?= Html::submitButton('Save', ['class' => 'btn btn-larger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
