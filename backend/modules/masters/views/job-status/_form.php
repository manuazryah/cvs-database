<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JobStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-status-form form-inline">
    <?= \common\widgets\Alert::widget() ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'job_status')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>   <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success mrg-top-btn']) ?>
            <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success mrg-top-btn']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
