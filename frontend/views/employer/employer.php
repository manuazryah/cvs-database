<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use common\models\Industry;
use common\models\Skills;
use yii\helpers\ArrayHelper;

$industry_datas = Industry::find()->where(['!=', 'id', 0])->andWhere(['status' => 1])->all();
$skills_datas = Skills::find()->where(['!=', 'industry', 0])->andWhere(['status' => 1])->all();
$city_datas = ArrayHelper::map(\common\models\City::find()->orderBy(['city' => SORT_ASC])->all(), 'id', function($model) {
            return common\models\Country::findOne($model['country'])->country_name . ' - ' . $model['city'];
        }
);
$latest_cvs = common\models\CandidateProfile::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(5)->all();
?>
<div class="site-banner right-img">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="banner-content">
                    <h1>Search between more them <br> 50,000 open CV's.</h1>
                    <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.<br> Nam eget dui consequat vitae, eleifend ac etiam rhoncus</p>
                </div>
                <div class="job-search">
                    <div class="form-group col-md-6 padding-left b-r radius">
                        <input type="text" class="form-control" placeholder="Job title / keywords">
                        <div class="search_icon"><span class="ti-briefcase"></span></div>
                    </div>
                    <div class="form-group col-md-6 padding-left radius2">
                        <input type="text" class="form-control" placeholder="City / zip code">
                        <div class="search_icon"><span class="ti-location-pin"></span></div>
                    </div>
                    <div class="btn-search">
                        <a href="#" class="btn btn-default">Search</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent">
    <div class="container skill">
        <div class="row">
            <div class="col-md-9">
                <div class="page-heading">
                    <h2>Find CV's by Skill, Industry & Location</h2>
                    <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu.</p>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#Industry">CV's By Industry</a></li>
                    <li><a data-toggle="tab" href="#Skills">CV's By Skills</a></li>
                    <li><a data-toggle="tab" href="#Location">CV's By Location</a></li>
                    <li class="pull-right"><a href="#" class="view">View all CV's</a></li>
                </ul>
                <div class="tab-content">
                    <div id="Industry" class="tab-pane fade in active">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($industry_datas as $industry_data) { ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $industry_data->industry_name ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="Skills" class="tab-pane fade">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($skills_datas as $skills_data) { ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $skills_data->skill ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div id="Location" class="tab-pane fade">
                        <div class="col-md-4 padding-left">
                            <ul class="unstyled">
                                <?php foreach ($city_datas as $city_data) {
                                    ?>
                                    <li>
                                        <a href="#"><i class="fa fa-angle-right"></i> <?= $city_data ?></a>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="Resume pad0">
                    <img class="img-responsive" src="images/home/2-sec-bg.jpg" alt="" title=""/>
                </div>
            </div>
        </div>
    </div>
    <section class="featured">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-heading">
                        <h2>Featured CV's</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-bg">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><div class="tab-image"><img src="<?= Yii::$app->homeUrl ?>images/home/img1.jpg" alt="" class="img-responsive"></div><h1>Web Project Manager - Team of PHP MySQL Developers <p>Agricultural Sceences</p></h1></td>
                                    <td class="work-time">Full Time</td>
                                    <td><span class="ti-location-pin"></span> Toulouse, France</td>
                                    <td><a href="#" class="table-btn-default">View Job</a></td>
                                </tr>
                                <tr>
                                    <td><div class="tab-image"><img src="<?= Yii::$app->homeUrl ?>images/home/img2.jpg" alt="" class="img-responsive"></div><h1>Urgent Opening for PHP Developer <p>Agricultural Sceences</p></h1></td>
                                    <td class="work-time part">Part Time</td>
                                    <td><span class="ti-location-pin"></span> Toulouse, France</td>
                                    <td><a href="#" class="table-btn-default">View Job</a></td>
                                </tr>
                                <tr>
                                    <td><div class="tab-image"><img src="<?= Yii::$app->homeUrl ?>images/home/img3.jpg" alt="" class="img-responsive"></div><h1>Urgent Require- Web Developer <p>Agricultural Sceences</p></h1></td>
                                    <td class="work-time part">Part Time</td>
                                    <td><span class="ti-location-pin"></span> Toulouse, France</td>
                                    <td><a href="#" class="table-btn-default">View Job</a></td>
                                </tr>
                                <tr>
                                    <td><div class="tab-image"><img src="<?= Yii::$app->homeUrl ?>images/home/img4.jpg" alt="" class="img-responsive"></div><h1>Nodejs,Angularjs Developer <p>Agricultural Sceences</p></h1></td>
                                    <td class="work-time">Full Time</td>
                                    <td><span class="ti-location-pin"></span> Toulouse, France</td>
                                    <td><a href="#" class="table-btn-default">View Job</a></td>
                                </tr>
                                <tr>
                                    <td><div class="tab-image"><img src="<?= Yii::$app->homeUrl ?>images/home/img5.jpg" alt="" class="img-responsive"></div><h1>Software Developer -IT Co <p>Agricultural Sceences</p></h1></td>
                                    <td class="work-time Free">Free lancer</td>
                                    <td><span class="ti-location-pin"></span> Toulouse, France</td>
                                    <td><a href="#" class="table-btn-default">View Job</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="employe ptop60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Top Employes</h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="success_story">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-right">
                    <div class="page-heading2">
                        <h1>CV<span>s</span></h1>
                        <strong>success stories</strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="testi-slider">
                        <ul class="slides list-inline">
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="testi-box clearfix text-center">
                                    <img src="images/home/t1.png" alt="" class="img-responsive">
                                    <div class="content">
                                        <p>Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p>
                                        <div class="content-hr"></div>
                                        <h4>Wabidullah Sharif</h4>
                                        <span>Web Designer</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="visitor">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading heading3">
                        <h2>We are Popular <span>Everywhere</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="vector_map">
                        <img src="images/home/map.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="jobxpress">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 padding-left">
                    <div class="left-col">
                        <div class="col-text">
                            <div class="page-heading heading4">
                                <h2>Join Thousands of Companies That Realy on <span>CVs Database</span></h2>
                                <hr>
                                <p>Sed consequat, leo eget bibendum sodales, augue cursus nunc, quis <br /> gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum <br />purus quam, scelerisque ut.</p>
                                <a href="#" class="btn Read_more">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 padding-left">
                    <div class="right-col"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Latest News form <span>CVs Database</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block1">
                        <a href="#"><img src="images/home/blog1.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 padding-left text-right">
                                <h3>April 25, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies tellus eget condimentum nisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="block1">
                        <a href="#"><img src="images/home/blog2.jpg" alt="" class="img-responsive"></a>
                        <div class="block1_desc">
                            <div class="col-md-2 col-sm-2 padding-left text-right">
                                <h3>March 13, <span>2017</span></h3>
                            </div>
                            <div class="col-md-10 col-sm-10">
                                <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies tellus eget condimentum nisi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>