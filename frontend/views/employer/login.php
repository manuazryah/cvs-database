<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
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
                <h1>Dear user, log in to access the employer area!</h1>
                <?= \common\widgets\Alert::widget(); ?>
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'email')->textInput(['autofocus' => '', 'placeholder' => 'Email']) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                <?php // $form->field($model, 'rememberMe')->checkbox() ?>
                <div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                </div>
                <div class="clearfix"></div>
                <div class="separator">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="<?= Yii::$app->homeUrl; ?>employer/forgot" class="to_register">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= Yii::$app->homeUrl; ?>employer/register" class="to_register">New User Register Here?</a>
                        </div>
    <!--                    <p class="change_link">
                            <a href="<?= Yii::$app->homeUrl; ?>employer/forgot" class="to_register">Forgot your password?</a>
                            <a href="<?= Yii::$app->homeUrl; ?>employer/register" class="to_register">New User Register Here?</a>
                        </p>-->
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