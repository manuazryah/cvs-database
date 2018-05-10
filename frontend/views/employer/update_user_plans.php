<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Package Details';
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
                    <button id="pack-histry-btn" class="btn btn-warning  btn-icon btn-icon-standalone" style="float:right;margin-left: 20px;">
                        <i class="fa fa-history"></i>
                        <span>Package History</span>
                    </button>
                    <?= Html::a('<i class="fa fa-toggle-up"></i><span> Upgrade Your Package</span>', ['upgrade-package'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right;']) ?>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <p class="pack-head">Remaining (Current Credit + Previous Credit)<span class="pack-head-span"> <?= $user_package->no_of_downloads_left ?></span></p>
                            </div>
                            <div class="col-md-6">
                                <p class="pack-head">Credits expiry on <span class="pack-head-span"> <?= date("d-M-Y", strtotime($user_package->end_date)); ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="current_pack">
                        <div class="panel-heading">
                            <h3 class="panel-title"> Current Package</h3>
                        </div>
                        <table class="table table-responsive">
                            <tr>
                                <th>Package Name</th>
                                <th>Transaction</th>
                                <th>Package Credit</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <tr>
                                <td><?= $user_package->package != ''?\common\models\Packages::findOne($user_package->package)->package_name :'' ?></td>
                                <td><?= $user_package->transaction_id ?></td>
                                <td><?= $user_package->package_credit ?></td>
                                <td><?= date("d-M-Y", strtotime($user_package->start_date)); ?></td>
                                <td><?= date("d-M-Y", strtotime($user_package->end_date)); ?></td>
                                <td>Active</td>
                                <td><?= Html::a('Print Invoice', ['employer/reports', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $user_package->id)], ['class' => 'invoice-print','target'=>'_blank']) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <div id="pack-histry">
                        <div class="panel-heading">
                            <h3 class="panel-title">Package History</h3>


                        </div>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'plan',
                                    'label' => 'Package Name',
                                    'format' => 'raw',
                                    'filter' => Html::activeDropDownList($searchModel, 'plan', ArrayHelper::map(common\models\Packages::find()->all(), 'id', 'package_name'), ['class' => 'form-control', 'id' => 'package', 'prompt' => '']),
                                    'value' => function ($data) {
                                        return common\models\Packages::findOne($data->plan)->package_name;
                                    },
                                ],
                                'transaction_id',
                                'package_credit',
                                [
                                    'attribute' => 'start_date',
                                    'value' => function ($data) {
                                        return date("d-M-Y", strtotime($data->start_date));
                                    },
                                ],
                                [
                                    'attribute' => 'end_date',
                                    'value' => function ($data) {
                                        return date("d-M-Y", strtotime($data->end_date));
                                    },
                                ],
                                [
                                    'attribute' => 'status',
                                    'value' => function ($data) {
                                        if ($data->status == 0) {
                                            return 'Expired';
                                        } else {
                                            return '';
                                        }
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'contentOptions' => [],
                                    'header' => 'Actions',
                                    'template' => '{print}',
                                    'buttons' => [
                                        'print' => function ($url, $model) {
                                            return Html::a('Print Invoice', $url, [
                                                        'title' => Yii::t('app', 'print'),
                                                        'class' => 'invoice-print',
                                                        'target' => '_blank',
                                            ]);
                                        },
                                    ],
                                    'urlCreator' => function ($action, $model) {
                                        if ($action === 'print') {
                                            $url = Url::to(['employer/report', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id)]);
                                            return $url;
                                        }
                                    }
                                ],
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#pack-histry-btn').bind('click', function (e) {
            $('#pack-histry').toggle('show');
        });
        $('#pack-histry').toggle('hide');
        $('.summary').css('display', 'none');
    });
</script>


