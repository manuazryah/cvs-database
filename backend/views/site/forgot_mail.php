<?php

use yii\helpers\Html;
?>

<html>
    <head>
        <title>Forgot Password</title>
        <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
    </head>
    <body>
        <div class="mail-body">
            <div class="content" style="margin: 0px 15%;border: 1px solid #d4d1d1;">
                <?= Html::img('http://'.Yii::$app->getRequest()->serverName . '/cvs/admin/images/site-logo.png', $options = ['style' => 'width:200px;margin:0 auto;display: inherit;']) ?>
                <div class="content-detail" style="padding: 0px 10%;">
                    <h2>Reset Your Password</h2>
                    <p>Hi <?= $model->name ?>,</p>
                    <p>You are requested to reset your password for your CVS Database  Admin Panel Login. Click the below button to reset it</p>
                    <!--<p><a href="<?= Yii::$app->homeUrl ?>employer/new-password?token=<?= $val ?>" class="btn btn-success btn-icon">Reset Password</a></p>-->
                    <p style="margin: 30px 0px;"><a href="<?= Yii::$app->getRequest()->serverName ?><?= Yii::$app->homeUrl ?>site/new-password?token=<?= $val ?>" style="background: #2881c0;padding: 10px 20px;text-decoration: none;color: white;">Reset Password</a></p>
                </div>
            </div>
        </div>



    </body>
</html>