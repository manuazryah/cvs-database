<?php
/* @var $this yii\web\View */
?>
<div class="site-banner">
    <div class="banner-overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="banner-content">
                    <h1>Search between more them <br /> 50,000 open jobs.</h1>
                    <p>Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi.<br /> Nam eget dui consequat vitae, eleifend ac etiam rhoncus</p>
                </div>
            </div>
            <div class="col-md-4" style="position: relative; float: right;">
                <div id="form" class="form-fixed">
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li><a href="#login" role="tab" data-toggle="tab" aria-expanded="false">Log in</a></li>
                            <li class="active"><a href="#signup" role="tab" data-toggle="tab" aria-expanded="true">Sign up</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="login">
                                <form id="login">
                                    <div class="form-group">
                                        <label> Username or E-mail</label>
                                        <input type="email" class="form-control" id="email" required="" data-validation-required-message="Please enter your email address." autocomplete="off">
                                        <div class="search_icon"><span class="ti-user"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label> Password</label>
                                        <input type="password" class="form-control" id="password" required="" data-validation-required-message="Please enter your password" autocomplete="off">
                                        <div class="search_icon"><span class="ti-pin"></span></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-larger btn-block">Log in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade active in" id="signup">
                                <form id="signup">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" id="first_name" required="" data-validation-required-message="Please enter your name." autocomplete="off">
                                        <div class="search_icon"><span class="ti-user"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label> Email </label>
                                        <input type="email" class="form-control" id="email" required="" data-validation-required-message="Please enter your email address." autocomplete="off">
                                        <div class="search_icon"><span class="ti-email"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Password </label>
                                        <input type="password" class="form-control" id="password" required="" data-validation-required-message="Please enter your password" autocomplete="off">
                                        <div class="search_icon"><span class="ti-pin"></span></div>
                                    </div>
                                    <div class="form-group">
                                        <label> Confirm Password </label>
                                        <input type="password" class="form-control" id="password" required="" data-validation-required-message="Please enter your password" autocomplete="off">
                                        <div class="search_icon"><span class="ti-pin"></span></div>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-larger btn-block">Sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<main id="maincontent" class="ptop0">
    <section class="about">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Make a Difference with Your Online Resume</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <a href="#" class="btn btn-default">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="employe">
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
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe1.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe6.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe5.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe4.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe3.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe2.png" alt="" class="img-responsive"  /></a>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="client">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/employe1.png" alt="" class="img-responsive"  /></a>
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
                        <h1>Job <span>Xpress</span></h1>
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
                                    <img src="<?= yii::$app->homeUrl; ?>images/home/t1.png" alt="" class="img-responsive">
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
                                    <img src="<?= yii::$app->homeUrl; ?>images/home/t1.png" alt="" class="img-responsive">
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
                        <img src="<?= yii::$app->homeUrl; ?>images/home/map.png" alt="" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="page-heading">
                        <h2>Latest News form <span>Jobxpress</span></h2>
                        <p>In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="block1">
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog1.jpg" alt="" class="img-responsive"></a>
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
                        <a href="#"><img src="<?= yii::$app->homeUrl; ?>images/home/blog2.jpg" alt="" class="img-responsive"></a>
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
