<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CandidateProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'candidate_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'nationality') ?>

    <?= $form->field($model, 'current_country') ?>

    <?php // echo $form->field($model, 'current_city') ?>

    <?php // echo $form->field($model, 'expected_salary') ?>

    <?php // echo $form->field($model, 'job_type') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'job_status') ?>

    <?php // echo $form->field($model, 'executive_summary') ?>

    <?php // echo $form->field($model, 'industry') ?>

    <?php // echo $form->field($model, 'skill') ?>

    <?php // echo $form->field($model, 'hobbies') ?>

    <?php // echo $form->field($model, 'extra_curricular_activities') ?>

    <?php // echo $form->field($model, 'languages_known') ?>

    <?php // echo $form->field($model, 'driving_licences') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'date_of_updation') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
