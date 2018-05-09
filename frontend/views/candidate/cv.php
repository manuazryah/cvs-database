<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<main id="maincontent" class="my-account">
    <section class="resume manage">
        <div class="container"> 

            <!-- Job Header start -->
            <div class="job-header">
                <div class="jobinfo">
                    <div class="row">
                        <div class="col-md-8 col-sm-8"> 
                            <!-- Candidate Info -->
                            <div class="candidateinfo">
                                <div class="userPic"> <?php
                                    if ($model->photo != '') {
                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                        if (file_exists($dirPath)) {
                                            echo '<img class="img-responsive" src="' . Yii::$app->homeUrl . 'uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo . '"/>';
                                        } else {
                                            echo '';
                                        }
                                    }
                                    ?></div>
                                <div class="title"><?= $user_details->user_name ?></div>
                                <div class="desi"><?= $model->title ?></div>
                                <div class="loctext"><i class="fa fa-history" aria-hidden="true"></i> Employed but looking for job</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4"> 
                            <!-- Candidate Contact -->
                            <div class="candidateinfo">
                                <div class="loctext"><i class="fa fa-phone" aria-hidden="true"></i> <?= $user_details->phone ?></div>
                                <div class="loctext"><i class="fa fa-envelope" aria-hidden="true"></i> <?= $user_details->email ?></div>
                                <div class="loctext"><i class="fa fa-globe" aria-hidden="true"></i> www.mywebsite.com</div>
                                <div class="cadsocial"> <a href="http://www.twitter.com" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="<?= $user_details->google_link ?>" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> <a href="<?= $user_details->facebook_link ?>" target="_blank"> <i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="<?= $user_details->linked_in_link ?>" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>  <a href="<?= $user_details->youtube_link ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>  </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="jobButtons"> 
                    <a href="#." class="btn apply"><i class="fa fa-paper-plane" aria-hidden="true"></i> Edit my online CV</a>
                    <?= Html::a('<img width="20" src="' . Yii::$app->homeUrl . 'images/pdf-icon.png" > Download my online CV', ['pdf-export'], ['target' => '_blank', 'class' => 'btn']) ?>
                    <?= Html::a('<img width="20" src="' . Yii::$app->homeUrl . 'images/word-icon.png" > Download my online CV', ['word-export'], ['target' => '_blank', 'class' => 'btn']) ?>
                </div>
            </div>

            <!-- Job Detail start -->
            <div class="row">
                <div class="col-md-8"> 
                    <!-- About Employee start -->
                    <div class="job-header">
                        <div class="contentbox">
                            <h3>About me</h3>
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare malesuada a mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sagittis, quam a fringilla congue, turpis turpis molestie ligula, ut laoreet elit arcu sed nulla. Sed at quam commodo, egestas turpis eget, fringilla dui. Etiam sit amet nulla metus. Etiam iaculis lobortis ultricies. <strong>Maecenas maximus magna a metus consectetur, vel fermentum nisl ultrices</strong>. Quisque eget ante id dui posuere ullamcorper ut molestie eros. Aliquam ultrices lacinia risus, at lacinia ante vehicula id. Nulla in lectus dignissim, egestas purus sit amet, mattis libero. Maecenas ullamcorper rutrum porta. </p>
                            <ul class="check-list">
                                <li>In non augue eget purus placerat aliquet sit amet lobortis lacus.</li>
                                <li>Curabitur interdum nisl quis placerat ornare.</li>
                                <li>Curabitur ornare enim ac aliquam efficitur.</li>
                                <li>Etiam volutpat leo et orci luctus, blandit accumsan arcu placerat.</li>
                                <li>Proin egestas dui et pulvinar pellentesque.</li>
                                <li>In ultricies nulla eget lacus tempor lobortis.</li>
                            </ul>
                            <span><?= $model->executive_summary ?></span>
                        </div>
                    </div>

                    <!-- Education start -->
                    <div class="job-header">
                        <div class="contentbox">
                            <h3>Education</h3>
                            <ul class="educationList">
                                <li>
                                    <div class="date">31<br>
                                        May<br>
                                        2012</div>
                                    <h4>Masters Degree</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare malesuada a mauris.</p>
                                    <div class="clearfix"></div>
                                </li>
                                <li>
                                    <div class="date">31<br>
                                        May<br>
                                        2012</div>
                                    <h4>Masters Degree</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare malesuada a mauris.</p>
                                    <div class="clearfix"></div>
                                </li>
                                <li>
                                    <div class="date">31<br>
                                        May<br>
                                        2012</div>
                                    <h4>Masters Degree</h4>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare malesuada a mauris.</p>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Experience start -->
                    <div class="job-header">
                        <div class="contentbox">
                            <h3>Experience</h3>
                            <ul class="experienceList">
                                <li>
                                    <div class="row">
                                        <div class="col-md-2"><img class="img-responsive" src="<?= Yii::$app->homeUrl ?>images/experience/emplogo1.jpg" alt="your alt text"></div>
                                        <div class="col-md-10">
                                            <h4>Company Name</h4>
                                            <div class="row">
                                                <div class="col-md-6">www.companywebsite.com</div>
                                                <div class="col-md-6">From 2014 - Present</div>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2"><img class="img-responsive" src="<?= Yii::$app->homeUrl ?>images/experience/emplogo1.jpg" alt="your alt text"></div>
                                        <div class="col-md-10">
                                            <h4>Company Name</h4>
                                            <div class="row">
                                                <div class="col-md-6">www.companywebsite.com</div>
                                                <div class="col-md-6">From 2014 - Present</div>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-2"><img class="img-responsive" src="<?= Yii::$app->homeUrl ?>images/experience/emplogo1.jpg" alt="your alt text"></div>
                                        <div class="col-md-10">
                                            <h4>Company Name</h4>
                                            <div class="row">
                                                <div class="col-md-6">www.companywebsite.com</div>
                                                <div class="col-md-6">From 2014 - Present</div>
                                            </div>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pellentesque massa vel lorem fermentum fringilla. Pellentesque id est et neque blandit ornare</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="job-header">
                        <div class="contentbox">
                            <div class="page-heading">
                                <h4>Uploded CV</h4>
                                <div class="contact_details col-md-12 p-l">
                                    <?php
                                    if ($model->upload_resume != '') {
                                        $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                        if (file_exists($dirPath)) {
                                            if ($model->upload_resume != '') {
                                                if ($model->upload_resume == 'doc' || $model->upload_resume == 'docx') {
                                                    $url = 'http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'uploads/candidate/resume/' . $model->id . '.' . $model->upload_resume;
                                                    ?>
                                                    <iframe src='https://docs.google.com/viewer?url=<?= $url ?>&embedded=true' frameborder='0' width="100%" height="300px"></iframe>
                                                <?php } elseif ($model->upload_resume == 'pdf') { ?>
                                                    <iframe src="<?= Yii::$app->homeUrl ?>uploads/candidate/resume/<?= $model->id ?>.<?= $model->upload_resume ?>" width="100%" height="300px" frameborder="0" ></iframe>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4"> 
                    <!-- Candidate Detail start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3>Candidate Detail</h3>
                            <ul class="jbdetail">
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Experience</div>
                                    <div class="col-md-6 col-xs-6"><span>5 Years</span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Age</div>
                                    <div class="col-md-6 col-xs-6"><span>28 Years</span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Current Salary($)</div>
                                    <div class="col-md-6 col-xs-6"><span class="permanent">10K - 12K</span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Expected Salary($)</div>
                                    <div class="col-md-6 col-xs-6"><span class="freelance">14K - 18K</span></div>
                                </li>
                                <li class="row">
                                    <div class="col-md-6 col-xs-6">Education Levels</div>
                                    <div class="col-md-6 col-xs-6"><span>Masters</span></div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Google Map start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3>Skills</h3>
                            <div class="skillswrap"> 
                                <!-- Skill -->
                                <h5>Photoshop</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%"> <span>90%</span> </div>
                                </div>
                                <!-- Skill -->
                                <h5>HTML5</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 85%"> <span>85%</span> </div>
                                </div>
                                <!-- Skill -->
                                <h5>Jquery</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 90%"> <span>90%</span> </div>
                                </div>
                                <!-- Skill -->
                                <h5>Wordpress</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span>60%</span> </div>
                                </div>
                                <!-- Skill -->
                                <h5>PHP</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:35%"> <span>35%</span> </div>
                                </div>
                                <!-- Skill -->
                                <h5>Javascript</h5>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 95%"> <span>95%</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Company start -->
                    <div class="job-header">
                        <div class="jobdetail">
                            <h3>Contact <?= $user_details->user_name ?></h3>
                            <div class="formpanel">
                                <div class="formrow">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </div>
                                <div class="formrow">
                                    <input type="text" class="form-control" placeholder="Your Email">
                                </div>
                                <div class="formrow">
                                    <input type="text" class="form-control" placeholder="Phone">
                                </div>
                                <div class="formrow">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </div>
                                <div class="formrow">
                                    <textarea class="form-control" placeholder="Message"></textarea>
                                </div>
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-larger btn-block submit']) ?>
                                <?php // Html::a('Reset', ['reset-password'], ['class' => 'btn btn-large btn-default']) ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script type="text/javascript">
    $('#candidateprofile-upload_resume').bind('change', function (e) {
        var fileExtension = ['pdf', 'doc'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only formats are allowed : " + fileExtension.join(', '));
        } else {
            var f = this.files[0]
            if (f.size > 2097152 || f.fileSize > 2097152)
            {
                alert("Allowed file size exceeded. (Max. 2 MB)")
                this.value = null;
            } else {
                $("#cv-upload").submit();
            }
        }
    });
</script>
