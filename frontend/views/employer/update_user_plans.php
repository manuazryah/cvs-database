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
<div class="packages-index admin-users-index">

    <div class="row">
        <div class="col-md-12">

            <div class="">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="package-button-sec">
                    <?= \common\widgets\Alert::widget() ?>
                    <button id="pack-histry-btn" class="btn btn-warning button1 btn-icon" style="float:right;margin-left: 20px; background: #2caef4;" title="Package History"><i class="fa fa-history" aria-hidden="true"></i>Package History</button>
                    <?= Html::a('<i class="fa fa-level-up"></i>Upgrade Your Package', ['upgrade-package'], ['class' => 'btn btn-warning  btn-icon  button1', 'style' => 'float:right; background: #0474ba;', 'title' => 'Upgrade Package']) ?>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="package-status">
                            <div class="col-md-6 pl0">
                                <p class="pack-head">Remaining Credit's (Previous + Current)<span class="pack-head-span"> <?= $user_package->no_of_downloads_left ?></span></p>
                            </div>
                            <div class="col-md-6 pr0">
                                <p class="pack-head">Credits expiry on <span class="pack-head-span"> <?= date("d-M-Y", strtotime($user_package->end_date)); ?></span></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
<!--                        <section class="pricing-table">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs pad0">
                                        <div class="package-details">
                                            <div class="pricing-heading">
                                                <div class="main-head">
                                                    <h1>Pricing</h1>
                                                    <h5>Table</h5>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>Validity</li>
                                                <li>Total Downloads</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 pad0">
                                        <div class="package-pricing bronze">
                                            <div class="pricing-heading">
                                                <div class="col-lg-12">
                                                    <h5>Platinum</h5>
                                                    <h1>500.00 $</h1>
                                                    <span>per/month</span>
                                                </div>
                                            </div>
                                            <ul>
                                                <li>90 Days</li>
                                                <li>750 Downloads</li>
                                            </ul>
                                            <div class="col-lg-12">
                                                <div class="buynow-sec">
                                                    <a class="buy-now" href="/cvs-database/employer/index">Buy Now</a>                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>-->
                        <div class="panel panel-default">
                            <div class="current_pack">
                                <div class="panel-heading sub">
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
                                        <td><?= $user_package->package != '' ? \common\models\Packages::findOne($user_package->package)->package_name : '' ?></td>
                                        <td><?= $user_package->transaction_id ?></td>
                                        <td><?= $user_package->package_credit ?></td>
                                        <td><?= date("d-M-Y", strtotime($user_package->start_date)); ?></td>
                                        <td><?= date("d-M-Y", strtotime($user_package->end_date)); ?></td>
                                        <td>Active</td>
                                        <td><?= Html::a('Print Invoice', ['employer/reports', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $user_package->id)], ['class' => 'invoice-print', 'target' => '_blank']) ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clearfix"></div>
                            <div id="pack-histry">
                                <div class="panel-heading sub">
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


