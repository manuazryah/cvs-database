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

    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
                <span><strong>For Support Contact Us: </strong><ul><li><a href="tel:+971 50 4752515"><i class="fa fa-phone"></i> +971 50 4752515</a></li><li><a href="mailto:info@cvs.ae"><i class="fa fa-envelope-o"></i> info@cvs.ae</a></li></ul></span>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <?= \common\widgets\Alert::widget() ?>
                    <?php
                    echo ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_package_view',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


