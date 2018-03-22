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
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  My Profile', ['index']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Edit Profile', ['update-profile']) ?>
                            </li>
                            <li>
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Online CV', ['online-curriculum-vitae']) ?>
                            </li>
                            <li class="active">
                                <?= Html::a('<i class="fa fa-caret-right"></i>  Reset Password', ['reset-password']) ?>
                            </li>
                            <li class="border-none">
                                <a href="#"><i class="fa fa-caret-right"></i> Sign Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="job_title">Personal <span class="color">Info</span></div>
                    <div class="profile-login-bg">
                        <div class="row p_b30">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" value="Bobby H. Robinson" type="text">
                                </div>
                                <!--/.form-group-->
                            </div>
                            <!--/.col-md-3-->
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input class="form-control" id="email" name="email" value="bobbyh.robinson@example.com" type="email">
                                </div>
                                <!--/.form-group-->
                            </div>
                            <!--/.col-md-3-->
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input class="form-control" id="mobile" name="mobile" value="732-727-4884" type="text">
                                </div>
                                <!--/.form-group-->
                            </div>
                            <!--/.col-md-3-->
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" value="732-727-4884" type="text">
                                </div>
                                <!--/.form-group-->
                            </div>
                            <!--/.col-md-3-->
                        </div>
                        <br/>

                        <div class="job_title">Address</div>
                        <div class="mtop15"></div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input class="form-control" id="state" name="state" value="American" type="text">
                        </div>
                        <!--/.form-group-->
                        <div class="form-group">
                            <label for="city">City</label>
                            <input class="form-control" id="city" name="city" value="Hispanic" type="text">
                        </div>
                        <!--/.form-group-->
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input class="form-control" id="street" name="street" value="272 Duke Lane" type="text">
                                </div>
                                <!--/.form-group-->
                            </div>
                            <!--/.col-md-8-->
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="zip">ZIP</label>
                                    <input class="form-control" id="zip" name="zip" value="08879 " type="text">
                                </div>
                                <!--/.form-group-->
                            </div>
                        </div>
                        <!--/.col-md-3-->
                        <div class="form-group p_b30">
                            <label for="additional-address">Additional Address Line</label>
                            <input class="form-control" id="additional-address" name="additional-address" type="text">
                        </div>
                        <!--/.form-group-->
                        <br>

                        <div class="job_title">About <span class="color">Me</span></div>
                        <div class="mtop15"></div>

                        <div class="form-group">
                            <label for="about-me">Some Words About Me</label>
                            <div class="form-group">
                                <textarea class="form-control" id="about-me" rows="3" name="about-me" required=""></textarea>
                            </div>
                            <!--/.form-group-->
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-large btn-default" id="submit">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>



