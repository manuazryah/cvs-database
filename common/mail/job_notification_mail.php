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
                    <p>Hi <?= $candidate->user_name ?>,</p>
                    <p>Your CV is viewed by <?= $employer->company_name ?></p>
                </div>
            </div>
        </div>



    </body>
</html>