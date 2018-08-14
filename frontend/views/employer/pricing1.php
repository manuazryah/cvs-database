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
                <?php
                if (!empty($model)) {
                    foreach ($model as $value) {
                        if (!empty($value)) {
                            ?>
                            <div class="col-md-4">
                                <div class="">
                                    <div class="panel-pricing">
                                        <div class="panel-heading">
                                            <i class="fa fa-pagelines"></i>
                                            <h3><?= $value->package_name ?></h3>
                                        </div>
                                        <div class="card-header">
                                            <h3 class="display-2"><span class="currency">$</span><?= $value->package_price ?><span class="period">/month</span></h3>
                                        </div>
                                        <ul class="list-group text-center">
                                            <li class="list-group-item"> <?= $value->no_of_days ?> Day Expired</li>
                                            <li class="list-group-item"> <?= $value->no_of_downloads ?> Downloads</li>
                                        </ul>
                                        <div class="panel-footer">
                                            <?= Html::a('SELECT', ['employer/index'], ['class' => 'btn btn-lg btn-default']) ?>
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