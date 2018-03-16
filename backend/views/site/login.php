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
                                        <img src="<?= Yii::$app->homeUrl; ?>images/site-logo.png"/>
                                </div>

                                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                                <h1>Dear user, log in to access the admin area!</h1>
                                <?= $form->field($model, 'user_name')->textInput(['autofocus' => '', 'placeholder' => 'Username']) ?>

                                <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password']) ?>

                                <?php // $form->field($model, 'rememberMe')->checkbox() ?>
                                <div>
                                        <?= Html::submitButton('Login', ['class' => 'btn btn-default submit', 'name' => 'login-button']) ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="separator">

                                        <p class="change_link">
                                                <a href="<?= Yii::$app->homeUrl; ?>site/forgot" class="to_register">Forgot your password?</a>
                                        </p>
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