<?php

use yii\helpers\Html;
?>

<div class="page_banner banner price-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12  col-12">
                <div class="apus-breadscrumb">
                    <div class="wrapper-breads">
                        <div class="wrapper-breads-inner">
                            <h3 class="bread-title">Pricing Tables</h3>
                            <div class="breadscrumb-inner">
                                <ol class="breadcrumb">
                                    <li><?= Html::a('Home', ['/employer/index']) ?> </li>
                                    <li><span class="active">Pricing Tables</span></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent">
    <section class="pricing-table">
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
                <?php
                if (!empty($model)) {
                    $i = 0;
                    foreach ($model as $value) {
                        if (!empty($value)) {
                            $i++;
                            if($i == 1){
                                $cls = 'free';
                            }elseif($i == 2){
                                $cls = 'platinum';
                            }
                            elseif($i == 3){
                                $cls = 'gold';
                            }
                            elseif($i == 4){
                                $cls = 'silver';
                            }
                            elseif($i == 5){
                                $cls = 'bronze';
                            }
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 pad0">
                                <div class="package-pricing <?= $cls ?>">
                                    <div class="pricing-heading">
                                        <div class="col-lg-12">
                                            <h5><?= $value->package_name ?></h5>
                                            <h1><?= $value->package_price ?> $</h1>
                                            <span>per/month</span>
                                        </div>
                                    </div>
                                    <ul>
                                        <li><?= $value->no_of_days ?> Days</li>
                                        <li><?= $value->no_of_downloads ?> Downloads</li>
                                    </ul>
                                    <div class="col-lg-12">
                                        <div class="buynow-sec">
                                            <?= Html::a('Buy Now', ['/employer/index'],['class'=>'buy-now']) ?>
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