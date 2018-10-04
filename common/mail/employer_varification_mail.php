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
                <?= Html::img('http://' . Yii::$app->getRequest()->serverName . '/images/site-logo.png', $options = ['style' => 'width:200px;margin:0 auto;display: inherit;']) ?>
                <div class="content-detail" style="padding: 0px 10%;">
                    <p>Thank you very much for signing up at www.cvsdatabase.com !</p></br>
                    <p>Please click on the below link to verify your email address:</p>
                    <p style="margin: 30px 0px;"><a href="https://<?= Yii::$app->getRequest()->serverName ?><?= Yii::$app->homeUrl ?>employer/email-verification?token=<?= Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id) ?>" style="background: #2881c0;padding: 10px 20px;text-decoration: none;color: white;">Click Here</a></p>
                    <h3 style="text-align: center;color: #464444;background: #ffffff;padding: 0px;">OR</h3>
                    <p> Copy & paste the below link to your browser</p>
                    <p style="color: #2881c0;"><?= Yii::$app->getRequest()->serverName ?><?= Yii::$app->homeUrl ?>employer/email-verification?token=<?= Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id) ?></p>
                    <p> For any queries/ support kindly email to admin@cvsdatabase.com</p>
                </div>
            </div>
        </div>
    </body>
</html>