<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\EmployerPackages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employer-packages-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'transaction_id')->textInput(['maxlength' => true, 'readonly' => TRUE]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $employers = ArrayHelper::map(common\models\Employer::findAll(['status' => 1]), 'id', 'first_name'); ?>
            <?= $form->field($model, 'employer_id')->dropDownList($employers, ['prompt' => '-Choose a Employer-', 'readonly' => TRUE]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php $packages = ArrayHelper::map(common\models\Packages::findAll(['status' => 1]), 'id', 'package_name'); ?>
            <?= $form->field($model, 'package')->dropDownList($packages, ['prompt' => '-Choose a Package-', 'readonly' => TRUE]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'start_date')->textInput(['readonly' => TRUE]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?php
            if (!isset($model->end_date) && $model->end_date != '') {
                $model->end_date = date('d-M-Y');
            } else {
                $model->end_date = date("d-m-Y", strtotime($model->end_date));
            }
            ?>
            <?=
            $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-M-yyyy'
                ]
            ])->label('Expiry Date');
            ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'no_of_downloads')->textInput(['readonly' => TRUE]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'no_of_downloads_left')->textInput() ?>

        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
