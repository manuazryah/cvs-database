<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Featured CVs';
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

                    <section class="mailbox-env">
                        <div class="row">
                            <div class="box">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="job-search">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Job title / keywords">
                                            <div class="search_icon"><span class="ti-briefcase"></span></div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="City / zip code">
                                            <div class="search_icon"><span class="ti-location-pin"></span></div>
                                        </div>
                                        <a href="#" class="btn btn-default">Search</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="col-lg-6 f-right">
                                        <div class="support-info">
                                            <p><strong>For Support Call Us / Whatsapp</strong></p>
                                            <p><i class="fa fa-phone"></i>+971 50 4752515</p>
                                            <p><i class="fa fa-clock-o"></i>UAE Time: 8AM - 8PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 btop ptop5 pbtm5 shortlist-f-link">
                                    <div class="col-lg-4 pad0 f-right">
                                        <a href="" class="">See Shortlisted CVs/ Folders<i class="fa fa-shortlist"></i></a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="box ptop5">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 top-box-btm">
                                    <div class="col-lg-4 brit"><p>Search Result : <span>Total 234,222 CVs Found</span></p></div>
                                    <div class="col-lg-8 pad0">
                                        <div class="col-lg-7"><p class="color-drk txt-center">You have 50/50 Credits for CV Download</p></div>
                                        <div class="col-lg-5 blft txt-right"><p>Your Credit Expiry on 03 Dec 2018</p></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 box">
                                <div class="job_title">Categories</div>
                                <div class="borderfull-width"></div>
                                <div class="clearfix"></div>
                                <div class="page-heading">
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Executive" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Executive">Executive</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Manager" name="ossm" checked="">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Manager">Manager</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Developer" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Developer">Developer</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Designer" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Designer">Designer</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Java" name="ossm" checked="">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Java">Java Developer</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Civil" name="ossm" checked="">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Civil">Civil Engineert</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Architect" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Architect">Architect</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Data" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Data">Data Entry Operator</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="SEO" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="SEO">SEO</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="hr" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="hr">HR </label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Assistent" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Assistent">Assistent Manager HR </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="job_title">Skills</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading">
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="PHP" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="PHP">PHP</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="HTML" name="ossm" checked="">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="HTML">HTML</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="CSS" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="CSS">CSS</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="JavaScript" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="JavaScript">JavaScript</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="jQueary" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="jQueary">jQueary</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="MySQL" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="MySQL">MySQL</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="Wordpress" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="Wordpress">Wordpress</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="job_title">Job Type</div>
                                <div class="borderfull-width"></div>
                                <div class="page-heading">
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="cb_9" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="cb_9">All Type</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="cb_8" name="ossm" checked="">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="cb_8">Full Time</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="cb_7" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="cb_7">part Time</label>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <div class="col-md-1 p-l p-r">
                                            <input type="checkbox" id="cb_6" name="ossm">
                                        </div>
                                        <div class="col-md-11 p-l p-r">
                                            <label for="cb_6">Freelancer</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 prit0">
                                <div class="col-md-12 col-sm-12 p-l">
                                    <div class="page-heading">
                                        <p><span class="color-drk">Your Search Filter</span>: "Sales", "UAE", "Dubai", "Male","1 year - 5year Experienced"</p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="page_listing candidate">
                                    <?php
                                    echo ListView::widget([
                                        'dataProvider' => $dataProvider,
                                        'itemView' => '_item',
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>


