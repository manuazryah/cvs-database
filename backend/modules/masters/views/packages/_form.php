<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form form-inline">
    <?= \common\widgets\Alert::widget() ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'package_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-2 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'no_of_days')->textInput() ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'package_price')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'no_of_downloads')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="form-group" style="margin-bottom: 5px;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success mrg-top-btn', 'style' => 'margin-top:0px;']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
