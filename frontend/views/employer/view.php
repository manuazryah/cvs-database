<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Profile Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index package-details">

    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="package-button-sec">
                <?= Html::a('<i class="fa-th-list"></i>Edit Your Profile', ['/employer/update'], ['class' => 'btn btn-warning  btn-icon  button1', 'style' => 'float: right; background: #2caef4;" title="Edit Your Profile"']) ?>
                <?=
                Html::a('<i class="fa fa-trash"></i>Delete Profile', ['/employer/delete-profile'], ['class' => 'btn btn-warning  btn-icon  button1', 'style' => 'float: right; background: #bd0707;" title="Delete Profile"', 'data' => [
                        'confirm' => 'Are you sure you want to delete your profile?',
                    ],])
                ?>
            </div>
            <div>
            </div>
            <div class="clearfix"></div>
            <div class="panel panel-default">
                <div class="modal fade" id="modal-6">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="clearfix"></div>
                    <main id="maincontent">
                        <section class="resume">
                            <div class="container-cv-view">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel-body resume-panel emp-company-view">
                                            <div class="col-md-12 pad0">
                                                <h4>Employer Details</h4>
                                                <div class="page-heading">
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Name</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->first_name ?> <?= $model->last_name ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Email</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->email ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Phone</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->phone ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Address</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->address ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Country</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->country != '' ? \common\models\Country::findOne($model->country)->country_name : '' ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Location</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->location ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 pad0">
                                                <h4>Company Details</h4>
                                                <div class="page-heading">
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Company Name</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->company_name ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Company Email</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->company_email ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Description (About your company)</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->description ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Company Phone Number</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->company_phone_number ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="contact_details col-md-4 pad-lft">
                                                            <span><strong>Position</strong></span>
                                                        </div>
                                                        <div class="contact_details col-md-8 pad-lft">
                                                            <span>: <?= $model->position ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>
        </div>
    </div>
</div>


