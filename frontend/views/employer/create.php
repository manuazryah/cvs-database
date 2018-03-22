<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Employer Sign Up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-layout">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                <div>
                    <img src="<?= Yii::$app->homeUrl; ?>dash/images/site-logo.png"/>
                </div>
                <h1>Dear user, sign up to access the employer area!</h1>
                <?= \common\widgets\Alert::widget(); ?>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'first_name')->textInput(['autofocus' => '', 'placeholder' => 'First Name']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'last_name')->textInput(['autofocus' => '', 'placeholder' => 'Last Name']) ?>
                    </div>
                </div>
                <?= $form->field($model, 'email')->textInput(['autofocus' => '', 'placeholder' => 'Email']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                <?php // $form->field($model, 'rememberMe')->checkbox() ?>
                <div>
                    <?= Html::submitButton('Register', ['class' => 'btn btn-default submit', 'name' => 'register-button']) ?>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?= Yii::$app->homeUrl; ?>employer/index" class="to_register">Back to login</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br />

                </div>
                <?php ActiveForm::end(); ?>
                <!-- form -->
            </section>
            <!-- content -->
        </div>
    </div>
    <div style="clear:both"></div>
</div>