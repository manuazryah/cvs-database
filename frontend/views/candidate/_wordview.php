<html>
    <head>
        <style type="text/css">
            tfoot{display: table-footer-group;}
            table { page-break-inside:auto;}
            tr{ page-break-inside:avoid; page-break-after:auto; }

            @page {
                size: A4;
            }
            @media print {
                thead {display: table-header-group;}
                tfoot {display: table-footer-group}
                /*tfoot {position: absolute;bottom: 0px;}*/
                .main-tabl{width: 100%}
                .footer {position: fixed ; left: 0px; bottom: 0px; right: 0px; font-size:10px; }
                .main-tabl{
                    -webkit-print-color-adjust: exact;
                    margin: auto;
                    /*tr{ page-break-inside:avoid; page-break-after:auto; }*/
                }

            }
            @media screen{
                .main-tabl{
                    width: 60%;
                }
            }
            body h6,h1,h2,h3,h4,h5,p,b,tr,td,span,div{
                color:#525252 !important;
            }
            table th{
                text-align: left !important;
            }
            .tbl{
                width: 100%;border-bottom: 2px solid #e1e1e1;padding: 15px 0px;
            }
            .tbl tr,th,td{
                border:none ! important;
            }
        </style>
    </head>
    <body>
        <main id="maincontent">
            <section class="resume">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body" style="">
                            <table class="tbl">
                                <tr>
                                    <td style="width: 90%">
                                        <table style="width: 100%;">
                                            <tr><td colspan="2"><strong><h4 style="margin-bottom: 20px;"><?= $model->name ?></h4></strong></td></tr>
                                            <tr>
                                                <td style="line-height: 30px;"><strong>Title : </strong><?= $model->title ?></td>
                                                <td style="line-height: 30px;"><strong>Nationality : </strong><?= $model->nationality != '' ? \common\models\Country::findOne($model->nationality)->country_name : '' ?></td>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><strong>Current Country : </strong><?= $model->current_country != '' ? \common\models\Country::findOne($model->current_country)->country_name : '' ?></td>
                                                <td style="line-height: 30px;"><strong>Current City:</strong> <?= $model->current_city != '' ? \common\models\City::findOne($model->current_city)->city : '' ?></td>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><strong>Expected Salary : </strong> <?= $model->expected_salary ?></td>
                                                <td style="line-height: 30px;"><strong>Job Type : </strong> <?= $model->job_type != '' ? \common\models\JobType::findOne($model->job_type)->job_type : '' ?></td>
                                            </tr>
                                            <tr>
                                                <td style="line-height: 30px;"><strong>Gender : </strong> <?= $model->gender != '' ? \common\models\Gender::findOne($model->gender)->gender : '' ?></td>
                                                <td style="line-height: 30px;"><strong>DOB : </strong> <?= $model->dob ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 10%">
                                        <?php
                                        if ($model->photo != '') {
                                            $dirPath = Yii::getAlias(Yii::$app->params['uploadPath']) . '/uploads/candidate/profile_picture/' . $model->id . '.' . $model->photo;
                                            if (file_exists($dirPath)) {
                                                echo '<img class="img-responsive" src="http://localhost/cvs-database/uploads/candidate/profile_picture/1.png"/>';
                                            } else {
                                                echo '';
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Job Status</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;"><?= $model->job_status != '' ? common\models\JobStatus::findOne($model->job_status)->job_status : '' ?></td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Executive summary</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;"><?= $model->executive_summary ?></td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Industry</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;">
                                        <?php
                                        if ($model->industry != '') {
                                            $industry = explode(',', $model->industry);
                                            $result = '';
                                            $i = 0;
                                            if (!empty($industry)) {
                                                foreach ($industry as $val) {

                                                    if ($i != 0) {
                                                        $result .= ', ';
                                                    }
                                                    $industries = common\models\Industry::findOne($val);
                                                    $result .= $industries->industry_name;
                                                    $i++;
                                                }
                                            }
                                            echo $result;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Key Skills</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;">
                                        <?php
                                        if ($model->skill != '') {
                                            $skill = explode(',', $model->skill);
                                            $result1 = '';
                                            $i = 0;
                                            if (!empty($skill)) {
                                                foreach ($skill as $value) {

                                                    if ($i != 0) {
                                                        $result1 .= ', ';
                                                    }
                                                    $skills = common\models\Skills::findOne($value);
                                                    $result1 .= $skills->skill;
                                                    $i++;
                                                }
                                            }
                                            echo $result1;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Work Experience</strong></th>
                                </tr>
                                <?php
                                if (!empty($model_experience)) {
                                    foreach ($model_experience as $experience) {
                                        ?>
                                        <tr>
                                            <td style="line-height: 30px;">
                                                <span><?= $experience->designation ?> at <?= $experience->company_name ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 30px;">
                                                <span>From : <?= date("M Y", strtotime($experience->from_date)) ?> to <?= date("M Y", strtotime($experience->to_date)) ?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 30px;">
                                                <span>Job Responsibilities:</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 30px;">
                                                <span><?= $experience->job_responsibility ?></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th colspan="5" style="line-height: 30px;"><strong>Education - Academic</strong></th>
                                </tr>
                                <?php
                                if (!empty($model_education)) {
                                    ?>
                                    <tr>
                                        <th style="line-height: 35px;">Course Name</th>
                                        <th style="line-height: 35px;">Colege/ University</th>
                                        <th style="line-height: 35px;">Country</th>
                                        <th style="line-height: 35px;">From Year</th>
                                        <th style="line-height: 35px;">To Year</th>
                                    </tr>
                                    <?php foreach ($model_education as $education) { ?>
                                        <tr>
                                            <td><?= $education->course_name != '' ? \common\models\Courses::findOne($education->course_name)->cource_code : '' ?></td>
                                            <td><?= $education->collage_university ?></td>
                                            <td><?= $education->country != '' ? \common\models\Country::findOne($education->country)->country_name : '' ?></td>
                                            <td><?= date("M Y", strtotime($education->from_year)) ?></td>
                                            <td><?= date("M Y", strtotime($education->to_year)) ?></td>
                                        </tr>
                                    <?php }
                                    ?>
                                    <?php
                                }
                                ?>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Interests/ Hobbies</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;"><?= $model->hobbies ?></td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Extra Curricular Activities</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;"><?= $model->extra_curricular_activities ?></td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table class="tbl">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Languages Known</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;">
                                        <?php
                                        if ($model->languages_known != '') {
                                            $language = explode(',', $model->languages_known);
                                            $result2 = '';
                                            $i = 0;
                                            if (!empty($language)) {
                                                foreach ($language as $language_data) {

                                                    if ($i != 0) {
                                                        $result2 .= ', ';
                                                    }
                                                    $languages = common\models\Languages::findOne($language_data);
                                                    $result2 .= $languages->language;
                                                    $i++;
                                                }
                                            }
                                            echo $result2;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                            <table style="width:100%">
                                <tr>
                                    <th style="line-height: 30px;"><strong>Driving License</strong></th>
                                </tr>
                                <tr>
                                    <td style="line-height: 30px;">
                                        <?php
                                        if ($model->driving_licences != '') {
                                            $driving_licence = explode(',', $model->driving_licences);
                                            $result3 = '';
                                            $i = 0;
                                            if (!empty($driving_licence)) {
                                                foreach ($driving_licence as $driving_licence_data) {

                                                    if ($i != 0) {
                                                        $result3 .= ', ';
                                                    }
                                                    $driving_licences = common\models\Country::findOne($driving_licence_data);
                                                    $result3 .= $driving_licences->country_name;
                                                    $i++;
                                                }
                                            }
                                            echo $result3;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>