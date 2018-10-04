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
                    <p>Contact Enquiry From Website</p>
                    <table style="width: 100%;text-align: left;margin-bottom: 15px;">
                        <tr>
                            <th>Name</th>
                            <th>:-</th>
                            <td><?= $model->name ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <th>:-</th>
                            <td><?= $model->email ?></td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <th>:-</th>
                            <td><?= $model->subject ?></td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <th>:-</th>
                            <td><?= $model->message ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>



    </body>
</html>