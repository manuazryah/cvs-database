<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'current_country')->textInput() ?>

    <?= $form->field($model, 'current_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position_looking_for')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qualification')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skill_set')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'experience')->textInput() ?>

    <?= $form->field($model, 'upload_cv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'date_of_creation')->textInput() ?>

    <?= $form->field($model, 'date_of_updation')->textInput() ?>

    <?= $form->field($model, 'email_varification_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
