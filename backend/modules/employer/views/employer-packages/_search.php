<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EmployerPackagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employer-packages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'transaction_id') ?>

    <?= $form->field($model, 'employer_id') ?>

    <?= $form->field($model, 'package') ?>

    <?= $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'no_of_days') ?>

    <?php // echo $form->field($model, 'no_of_days_left') ?>

    <?php // echo $form->field($model, 'no_of_views') ?>

    <?php // echo $form->field($model, 'no_of_views_left') ?>

    <?php // echo $form->field($model, 'no_of_downloads') ?>

    <?php // echo $form->field($model, 'no_of_downloads_left') ?>

    <?php // echo $form->field($model, 'created_date') ?>

    <?php // echo $form->field($model, 'updated_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
