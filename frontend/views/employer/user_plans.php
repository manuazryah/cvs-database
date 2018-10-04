<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PackagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upgrade Package';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .summary{
        display: none;
    }
</style>
<div class="packages-index admin-users-index">
    <main id="maincontent">
        <section class="pricing-table">
            <div class="">
                <div class="panel-heading mb30">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="">
                    <div class="col-lg-2 hidden-md hidden-sm hidden-xs pad0">
                        <div class="package-details">
                            <div class="pricing-heading">
                                <div class="main-head">
                                    <h1>Pricing</h1>
                                    <h5>Table</h5>
                                </div>
                            </div>
                            <ul>
                                <li class="features-div">Features</li>
                                <li>Validity</li>
                                <li>Total Downloads</li>
                            </ul>
                        </div>
                    </div>
                    <?php
                    if (!empty($model)) {
                        $i = 0;
                        foreach ($model as $value) {
                            if (!empty($value)) {
                                $i++;
                                if ($i == 1) {
                                    $cls = 'free';
                                } elseif ($i == 2) {
                                    $cls = 'platinum';
                                } elseif ($i == 3) {
                                    $cls = 'gold';
                                } elseif ($i == 4) {
                                    $cls = 'silver';
                                } elseif ($i == 5) {
                                    $cls = 'bronze';
                                }
                                ?>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12 pad0">
                                    <div class="package-pricing <?= $cls ?>">
                                        <div class="pricing-heading">
                                            <div class="col-lg-12">
                                                <h5><?= $value->package_name ?></h5>
                                                <h1><?= floatval($value->package_price) ?> $</h1>

                                            </div>
                                        </div>
                                        <ul>
                                            <div class="features-li">
                                                <li>Search our CV database of professional candidates.</li>
                                                <li>Advanced filter options.</li>
                                                <li>Your unlocked CVs stay permanently.</li>
                                            </div>
                                            <li><?= $value->no_of_days ?> Days</li>
                                            <li><?= $value->no_of_downloads ?> Downloads</li>
                                        </ul>
                                        <div class="col-lg-12">
                                            <div class="buynow-sec">
                                                <a href="javascript:;" onclick="jQuery('#modal-1').modal('show', {backdrop: 'fade'});" class="buy-now">Order Now</a>
                                                <?php if ($i == 1) { ?>
                                                    <?php // Html::a('Buy Now', 'javascript:void(0)', ['class' => 'buy-now']) ?>
                                                <?php } else { ?>
                                                    <?php // Html::a('Buy Now', ['select-plan', 'id' => Yii::$app->EncryptDecrypt->Encrypt('encrypt', $value->id)], ['class' => 'buy-now']) ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
    <div class="modal fade" id="modal-1">
        <div class="modal-dialog">
            <div class="modal-content" style="padding: 15px;border: 1px solid #1378bb;background: #d4ebf7;">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">CVS Database</h4>
                </div>

                <div class="modal-body" style="font-size: 14px;">
                    To upgrade your package, Kindly contact us <span style="color: #0e75ba;font-weight: 600;">Email :</span> <a style="color: #2986c3;" href="mailto:info@cvs.ae">admin@CVsDatabase.com</a>, <span style="color: #0e75ba;font-weight: 600;">Phone :</span> <a style="color: #2986c3;" href="tel:+971 50 4752515"> +971 50 4752515</a>
                </div>
            </div>
        </div>
    </div>

</div>


