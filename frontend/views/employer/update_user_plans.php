<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plan Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .plan-dtl-tbl th,td{
        padding: 15px 15px !important;
        font-size: 13px;
    }
    .plan-dtl-tbl tr,th,td{
        border: none !important;
    }
</style>
<div class="packages-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?= Html::a('<i class="fa fa-toggle-up"></i><span> Upgrade Your Plan</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right;']) ?>
                    <table class="table table-responsive plan-dtl-tbl">
                        <tr>
                            <th>Package Name</th>
                            <th>:</th>
                            <td><?= \common\models\Packages::findOne($user_package->package)->package_name ?></td>
                            <th>Start Date</th>
                            <th>:</th>
                            <td><?= $user_package->start_date ?></td>
                            <th>:</th>
                            <th>End Date</th>
                            <td><?= $user_package->end_date ?></td>
                        </tr>
                        <tr>
                            <th>Number of Downloads</th>
                            <th>:</th>
                            <td><?= $user_package->no_of_downloads ?></td>
                            <th>Number of Views</th>
                            <th>:</th>
                            <td><?= $user_package->no_of_views ?></td>
                            <th>:</th>
                            <th>Date of Creation</th>
                            <td><?= $user_package->created_date ?></td>
                        </tr>
                        <tr>
                            <th>Balance Downloads</th>
                            <th>:</th>
                            <td><?= $user_package->no_of_downloads_left ?></td>
                            <th>Balance Views</th>
                            <th>:</th>
                            <td><?= $user_package->no_of_views_left ?></td>
                            <th>:</th>
                            <th>Date of Updation</th>
                            <td><?= $user_package->updated_date ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


