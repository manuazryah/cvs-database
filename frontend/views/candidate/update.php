<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$this->title = 'Update Candidate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main id="maincontent">
    <section class="resume">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="" method="post" class="panel-body register-form">
                        <div class="form-group col-md-6 p-l">
                            <label>First Name</label>
                            <input required="" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Last Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Country</label>
                            <select class="form-control">
                                <option>--- Choose a Country ---</option>
                                <option>UAE</option>
                                <option>India</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>City</label>
                            <select class="form-control">
                                <option>--- Choose a City ---</option>
                                <option>Dubai</option>
                                <option>Cochin</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Phone Number</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Email</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-l">
                            <label>Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group col-md-6 p-r">
                            <label>Conform Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="form-group col-md-12 p-l">
                            <div class="g-recaptcha" data-sitekey="6LfASkMUAAAAAKb0YThDF1KSdEFtkltDfiBI9_iI"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?k=6LfASkMUAAAAAKb0YThDF1KSdEFtkltDfiBI9_iI&amp;co=aHR0cDovL2xvY2FsaG9zdDo4MA..&amp;hl=en&amp;v=v1520836262157&amp;size=normal&amp;cb=x36n1x5tj0x" width="304" height="78" role="presentation" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
                        </div>
                        <div class="col-md-12 p-l agree">
                            <input type="checkbox" id="agree">
                            <label for="agree">I agree the terms &amp; conditions</label>
                        </div>
                        <div class="clearfix"></div>
                        <button type="submit" class="btn btn-default" id="submit_btn" name="contact-submit">Submit</button>
                        <div class="col-md-12 p-l have-account">
                            <span>Already have an account? <a href="">Log in</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
