<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Details' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>

                </div>
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget(); ?>
                    <?php
                    echo \yii\helpers\Html::a('Back', Yii::$app->request->referrer);
                    ?>
                    <?= Html::a('<i class="ffas fa-eye"></i><span>Back</span>', [Yii::$app->request->referrer], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right;']) ?>
                    <section class="resume">
                        <div class="">
                            <div class="row">
                                <div class="col-md-12  contact-table">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <td>: <?= $contact_info->user_name ?></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>: <?= $contact_info->email ?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>: <?= $contact_info->phone ?></td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>: <?= $contact_info->address ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alternate Phone</th>
                                            <td>: <?= $contact_info->alternate_phone ?></td>
                                        </tr>
                                        <tr>
                                            <th>Alternate Address</th>
                                            <td>: <?= $contact_info->alternate_address ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>


