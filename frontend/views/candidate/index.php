<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page_banner banner employer-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="banner-heading">User Details</div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="my-account">
    <section class="manage">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="Resume">
                        <h1>My Account</h1>
                        <ul class="unstyled">
                            <li class="active">
                                <?= Html::a('<i class="fa fa-caret-right"></i>  My Profile', ['index']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Edit Profile', ['update-profile']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Online CV', ['online-curriculum-vitae']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Reset Password', ['reset-password']) ?>
                            </li>
                            <?php
                            echo '<li class="border-none">'
                            . Html::beginForm(['/candidate/logout'], 'post', ['style' => '']) . '<a><i class="fa fa-caret-right"></i>'
                            . Html::submitButton(
                                    'Sign out', ['class' => '', 'style' => 'background: white;border: none;']
                            ) . '</a>'
                            . Html::endForm()
                            . '</li>';
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                </div>
            </div>
        </div>
    </section>
</main>



