<?php

namespace frontend\controllers;

use Yii;
use common\models\Employer;
use common\models\EmployerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\web\Response;
use common\models\PackagesSearch;
use common\models\EmployerPackages;
use common\models\CvSearch;
use common\models\ShortList;
use common\models\CandidateProfileSearch;
use common\models\CvFilter;
use common\models\Country;
use yii\db\Expression;
use kartik\mpdf\Pdf;
use yii\helpers\ArrayHelper;
use common\models\ForgotPasswordTokens;
use common\models\EmployerRegister;

/**
 * EmployerController implements the CRUD actions for Employer model.
 */
class EmployerController extends Controller {

    public $layout = '@app/views/layouts/employer_dashboard';

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Employer models.
     * @return mixed
     */
    public function actionIndex() {
        if (!empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] != '') {
            return $this->redirect(array('employer/home'));
        }
        $flag = 1;
        $stat = 0;
        $this->layout = 'employer_home';
        $model_filter = new CvFilter();
        $model = new Employer();
        $model->scenario = 'login';
        $model_register = new EmployerRegister();
        if ($model_register->load(Yii::$app->request->post())) {
            if ($model_register->isNewRecord) {
                $model_register->password = Yii::$app->security->generatePasswordHash($model_register->password);
            }
            $model_register->review_status = 0;
            if ($model_register->validate() && $model_register->save()) {
                $this->addPackage($model_register);
                $this->sendMail($model_register);
                Yii::$app->session->setFlash('success', 'Thank you for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
                $model_register = new EmployerRegister();
                $flag = 1;
            } else {
                $flag = 0;
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                Yii::$app->SetValues->setLoginHistory(Yii::$app->session['candidate']['id'], 3);
                return $this->redirect(['employer/home']);
            } else {
                if (isset(Yii::$app->session['log-err']) && Yii::$app->session['log-err'] == 1) {
                    $stat = 1;
                    unset(Yii::$app->session['log-err']);
                }
                $flag = 1;
            }
        }
        return $this->render('employer', [
                    'model_filter' => $model_filter,
                    'model' => $model,
                    'model_register' => $model_register,
                    'flag' => $flag,
                    'stat' => $stat,
        ]);
    }

    public function actionCvSearch() {
        $this->layout = 'employer_search';
        $searchModel = new CandidateProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => 1]);
        $dataProvider->query->orderBy(['date_of_updation' => SORT_DESC]);
        $model_filter = new CvFilter();
        $active_candidate = $this->getActiveCandidate();
        if ($active_candidate != '' && !empty($active_candidate)) {
            $dataProvider->query->andWhere(['candidate_id' => $active_candidate]);
        }
        if ($model_filter->load(Yii::$app->request->post())) {
            if ($model_filter->keyword != '') {
                $keywords = $this->getFilterKeywords($model_filter->keyword);
                $dataProvider->query->andWhere(['id' => $keywords]);
            }
            if ($model_filter->location != '') {
//                $location_datas = $this->getLocationDatas($model_filter->location);
//                $dataProvider->query->andWhere(['id' => $location_datas]);
                $locations = $this->getLocations($model_filter->location);
                $dataProvider->query->andWhere(['id' => $locations]);
            }
            if ($model_filter->industries != '') {
                $filter_industry = $this->getFilterIndustry($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_industry]);
            }
            if ($model_filter->skills != '') {
                $filter_skills = $this->getFilterSkills($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_skills]);
            }
            if ($model_filter->job_types != '') {
                $filter_job_types = $this->getFilterJobType($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_job_types]);
            }
            if ($model_filter->salary_range != '') {
                $filter_salary_range = $this->getFilterSalaryRange($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_salary_range]);
            }
            if ($model_filter->gender != '') {
                $filter_gender = $this->getFilterGender($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_gender]);
            }
            if ($model_filter->language != '') {
                $filter_language = $this->getFilterLanguage($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_language]);
            }
            if ($model_filter->job_status != '') {
                $filter_job_status = $this->getFilterJobStatus($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_job_status]);
            }
            if ($model_filter->nationality != '') {
                $filter_nationality = $this->getFilterNationality($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_nationality]);
            }
            if ($model_filter->experience != '') {
                $filter_experience = $this->getFilterExperience($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_experience]);
            }
            if ($model_filter->folder_name != '') {
                $filter_folders = $this->getFilterFolder($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_folders]);
            }
        }
        return $this->render('search-result', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model_filter' => $model_filter,
        ]);
    }

    /**
     * Lists all Employer models.
     * @return mixed
     */
    public function actionLogin() {
        if (!empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] != '') {
            return $this->redirect(array('employer/home'));
        }
        $stat = 0;
        $this->layout = 'employer_login_dashboard';
        $model = new Employer();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                Yii::$app->SetValues->setLoginHistory(Yii::$app->session['employer_data']['id'], 3);
                return $this->redirect(array('employer/home'));
            } else {
                if ($model->email_varification == 0) {
                    $stat = 1;
                }
            }
        } return $this->render('login', [
                    'model' => $model,
                    'stat' => $stat,
        ]);
    }

    /**
     * Displays a single Employer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView() {
        $id = Yii::$app->session['employer_data']['id'];
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister() {
        $model = new Employer();
        $this->layout = 'employer_login_dashboard';
        $model->scenario = 'create';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isNewRecord) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }
            $model->review_status = 0;
            if ($model->validate() && $model->save()) {
                $this->addPackage($model);
                $this->sendMail($model);
                Yii::$app->session->setFlash('success', 'Thanku for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
//                return $this->redirect(['index']);
                $model = new Employer();
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /*
     * Add Employer Initial Package
     */

    public function addPackage($data) {
        $package = \common\models\Packages::findOne(1);
        $employe = Employer::find()->orderBy(['id' => SORT_DESC])->one();
        if (!empty($employe)) {
            $last = $employe->id + 1;
        } else {
            $last = 1;
        }
        $model = new EmployerPackages();
        $model->employer_id = $data->id;
        $model->package = $package->id;
        $model->start_date = date('Y-m-d');
        $model->end_date = date('Y-m-d', strtotime($model->start_date . ' + ' . ($package->no_of_days - 1) . ' days'));
        $model->no_of_days = $package->no_of_days;
        $model->no_of_days_left = $package->no_of_days;
        $tran_no = $this->GenerateTransactionNo();
        $model->transaction_id = $tran_no;
        $model->package_credit = $package->no_of_downloads;
        $model->no_of_downloads = $package->no_of_downloads;
        $model->no_of_downloads_left = $package->no_of_downloads;
        $model->created_date = date('Y-m-d');
        if ($model->save()) {
//            $this->PlanHistory($model, $package);
        }
        return;
    }

    public function sendMail($model) {
        $to = $model->email;
        $subject = 'Email verification';
//        echo $message = '
        $message = '
<html>
<head>

  <title>Email verification</title>
</head>
<body>
  <p>Thank you very much for signing up at www.cv-database.com !</p></br>
<p>Please click on the below link to verify your email address:</p>
  <table>

    <tr>
     <td style="padding: 30px 0px 30px 0px;"><a style=" background: #3498db; color: #ffffff;
  font-size: 16px;
  padding: 10px 20px 10px 20px;
  text-decoration: none; background-image: -webkit-linear-gradient(top, #3498db, #2980b9); background-image: -moz-linear-gradient(top, #3498db, #2980b9);background-image: -ms-linear-gradient(top, #3498db, #2980b9);background-image: -o-linear-gradient(top, #3498db, #2980b9);background-image: linear-gradient(to bottom, #3498db, #2980b9);-webkit-border-radius: 28;-moz-border-radius: 28;" href="http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'employer/email-verification?token=' . $model->id . '" >Click here</a></td>
    </tr>

  </table>
<p> For any queries/ support kindly email to info@cvdatabase.com</p>
</body>
</html>
';
//        exit;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: info@cvsdatabase.com' . "\r\n";

        mail($to, $subject, $message, $headers);
        return true;
    }

    public function actionHome() {
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $searchModel = new CandidateProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => 1]);
        $dataProvider->query->orderBy(['date_of_updation' => SORT_DESC]);
        $user_plans = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        $model = new CvSearch();
        $model_filter = new CvFilter();
        $active_candidate = $this->getActiveCandidate();
        if ($active_candidate != '' && !empty($active_candidate)) {
            $dataProvider->query->andWhere(['candidate_id' => $active_candidate]);
        }
        if ($model_filter->load(Yii::$app->request->post())) {
            if ($model_filter->keyword != '') {
                $keywords = $this->getFilterKeywords($model_filter->keyword);
                $dataProvider->query->andWhere(['id' => $keywords]);
            }
            if ($model_filter->location != '') {
                $locations = $this->getLocations($model_filter->location);
                $dataProvider->query->andWhere(['id' => $locations]);
            }
            if ($model_filter->industries != '') {
                $filter_industry = $this->getFilterIndustry($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_industry]);
            }
            if ($model_filter->skills != '') {
                $filter_skills = $this->getFilterSkills($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_skills]);
            }
            if ($model_filter->job_types != '') {
                $filter_job_types = $this->getFilterJobType($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_job_types]);
            }
            if ($model_filter->salary_range != '') {
                $filter_salary_range = $this->getFilterSalaryRange($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_salary_range]);
            }
            if ($model_filter->gender != '') {
                $filter_gender = $this->getFilterGender($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_gender]);
            }
            if ($model_filter->language != '') {
                $filter_language = $this->getFilterLanguage($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_language]);
            }
            if ($model_filter->job_status != '') {
                $filter_job_status = $this->getFilterJobStatus($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_job_status]);
            }
            if ($model_filter->nationality != '') {
                $filter_nationality = $this->getFilterNationality($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_nationality]);
            }
            if ($model_filter->experience != '') {
                $filter_experience = $this->getFilterExperience($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_experience]);
            }
            if ($model_filter->folder_name != '') {
                $filter_folders = $this->getFilterFolder($model_filter);
                $dataProvider->query->andWhere(['id' => $filter_folders]);
            }
        }
        return $this->render('dashboard', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'model_filter' => $model_filter,
                    'user_plans' => $user_plans,
        ]);
    }

    public function getActiveCandidate() {
        $can_arr = \common\models\Candidate::find()->where(['status' => 1])->all();
        $cv_data = [];
        foreach ($can_arr as $ind_val) {
            $cv_data[] = $ind_val->id;
        }
        return $cv_data;
    }

    public function getFilterFolder($data) {
        $cv_data = [];
        foreach ($data->folder_name as $value) {
            $query = new yii\db\Query();
            $query->select(['*'])->from('short_list')->andWhere(['folder_name' => $value]);
            $command = $query->createCommand();
            $result = $command->queryAll();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['candidate_id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterKeywords($data) {
        $cv_data = [];
        $arr = [];
        $query = new yii\db\Query();
        $query->select(['*'])->from('candidate_profile')->andWhere(['or', ['like', 'title', $data], ['like', 'executive_summary', $data], ['like', 'hobbies', $data],]);
        $command = $query->createCommand();
        $result = $command->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        $query1 = new yii\db\Query();
        $query1->select(['id'])->from('courses')->andWhere(['or', ['like', 'course_name', $data], ['like', 'cource_code', $data],]);
        $command1 = $query1->createCommand();
        $result1 = $command1->queryAll();
        if (!empty($result1)) {
            foreach ($result1 as $ind_val) {
                $course_details = \common\models\CandidateEducation::find()->where(['course_name' => $ind_val])->all();
                if (!empty($course_details)) {
                    foreach ($course_details as $course_detail) {
                        $arr[] = $course_detail['candidate_id'];
                    }
                }
            }
        }
        $query2 = new yii\db\Query();
        $query2->select(['*'])->from('work_experiance')->andWhere(['or', ['like', 'company_name', $data], ['like', 'designation', $data],]);
        $command3 = $query2->createCommand();
        $result3 = $command3->queryAll();
        if (!empty($result3)) {
            foreach ($result3 as $ind_val) {
                $arr[] = $ind_val['candidate_id'];
            }
        }
        $candidate_reference = \common\models\Candidate::find()->where(['user_id' => $data])->one();
        if (!empty($candidate_reference)) {
            $arr[] = $candidate_reference['id'];
        }

        if (!empty($arr)) {
            foreach ($arr as $value) {
                $result2 = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:candidate_id, candidate_id)'))->addParams([':candidate_id' => $value])->all();
                if (!empty($result2)) {
                    foreach ($result2 as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
        }
        return $cv_data;
    }

    public function getLocationDatas($data) {
        $data = explode("-", $data);
        $loc = '';
        foreach ($data as $val) {
            $loc .= $val . '|';
        }
        $loc = rtrim($loc, '|');
        $loc = str_replace(' ', '', $loc);
        $cv_data = [];
        $arr = [];
        $arr1 = [];
        $result = Yii::$app->db->createCommand("select id from city WHERE city REGEXP '" . $loc . "'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $arr[] = $ind_val['id'];
            }
        }
        if (!empty($arr)) {
            foreach ($arr as $value) {
                $result2 = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:current_city, current_city)'))->addParams([':current_city' => $value])->all();
                if (!empty($result2)) {
                    foreach ($result2 as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
        }
        $result1 = Yii::$app->db->createCommand("select id from country WHERE country_name REGEXP '" . $loc . "'")->queryAll();
        if (!empty($result1)) {
            foreach ($result1 as $ind_val) {
                $arr1[] = $ind_val['id'];
            }
        }
        if (!empty($arr1)) {
            foreach ($arr1 as $value) {
                $result3 = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:current_country, current_country)'))->addParams([':current_country' => $value])->all();
                if (!empty($result3)) {
                    foreach ($result3 as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
        }
        return $cv_data;
    }

    public function getFilterExperience($data) {
        $cv_data = [];
        $query = new yii\db\Query();
        foreach ($data->experience as $value) {
            if ($value == 1) {
                $query->select(['*'])
                        ->from('candidate_profile')
                        ->where([' >= ', 'total_experience', 1])
                        ->andWhere(['<', 'total_experience', 2]);
                $command = $query->createCommand();
                $result = $command->queryAll();
                if (!empty($result)) {
                    foreach ($result as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
            if ($value == 2) {
                $query->select(['*'])
                        ->from('candidate_profile')
                        ->where([' >= ', 'total_experience', 2])
                        ->andWhere(['<', 'total_experience', 5]);
                $command = $query->createCommand();
                $result = $command->queryAll();
                if (!empty($result)) {
                    foreach ($result as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
            if ($value == 3) {
                $query->select(['*'])
                        ->from('candidate_profile')
                        ->where([' >= ', 'total_experience', 5])
                        ->andWhere(['<', 'total_experience', 10]);
                $command = $query->createCommand();
                $result = $command->queryAll();
                if (!empty($result)) {
                    foreach ($result as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
            if ($value == 4) {
                $query->select(['*'])
                        ->from('candidate_profile')
                        ->where([' >= ', 'total_experience', 10])
                        ->andWhere(['<', 'total_experience', 15]);
                $command = $query->createCommand();
                $result = $command->queryAll();
                if (!empty($result)) {
                    foreach ($result as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
            if ($value == 5) {
                $query->select(['*'])
                        ->from('candidate_profile')
                        ->where([' >= ', 'total_experience', 15])
                        ->andWhere(['<', 'total_experience', 20]);
                $command = $query->createCommand();
                $result = $command->queryAll();
                if (!empty($result)) {
                    foreach ($result as $ind_val) {
                        $cv_data[] = $ind_val['id'];
                    }
                }
            }
        }
        return $cv_data;
    }

    public function getFilterNationality($data) {
        $cv_data = [];
        foreach ($data->nationality as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:nationality, nationality)'))->addParams([':nationality' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterJobStatus($data) {
        $cv_data = [];
        foreach ($data->job_status as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:job_status, job_status)'))->addParams([':job_status' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterLanguage($data) {
        $cv_data = [];
        foreach ($data->language as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:languages_known, languages_known)'))->addParams([':languages_known' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterGender($data) {
        $cv_data = [];
        foreach ($data->gender as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:gender, gender)'))->addParams([':gender' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterSalaryRange($data) {
        $cv_data = [];
        foreach ($data->salary_range as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:expected_salary, expected_salary)'))->addParams([':expected_salary' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterJobType($data) {
        $cv_data = [];
        foreach ($data->job_types as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:job_type, job_type)'))->addParams([':job_type' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterSkills($data) {
        $cv_data = [];
        foreach ($data->skills as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:skill, skill)'))->addParams([':skill' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getFilterIndustry($data) {
        $cv_data = [];
        foreach ($data->industries as $value) {
            $result = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:industry, industry)'))->addParams([':industry' => $value])->all();
            if (!empty($result)) {
                foreach ($result as $ind_val) {
                    $cv_data[] = $ind_val['id'];
                }
            }
        }
        return $cv_data;
    }

    public function getLocations($data) {
        $city_data = [];
        $cv_data = [];
        $cities = \common\models\City::find()->where(['id' => $data])->all();
        if (!empty($cities)) {
            foreach ($cities as $city) {
                $city_data[] = $city->id;
            }
        }
        $query2 = \common\models\CandidateProfile::find()->select('id')->where(['current_city' => $city_data])->all();
        if (!empty($query2)) {
            foreach ($query2 as $query2_data) {
                $cv_data[] = $query2_data->id;
            }
        }
        return $cv_data;
    }

    /**
     * Updates an existing Employer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate() {
        $id = Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->review_status = 0;
            $model->save();
            return $this->redirect(['update']);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Employer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->SetValues->updateLoginHistory();
        unset(Yii::$app->session['log-history']);
        unset(Yii::$app->session['employer_data']);
        Yii::$app->user->logout();
        return $this->redirect(['/employer/index']);
    }

    /**
     * Change Password.
     *
     * @return string
     */
    public function actionChangePassword() {
        $model = new \common\models\ChangeEmployerPassword();
        $id = Yii::$app->session['employer_data']['id'];
        $user = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', 'Password changed successfully.');
            $model = new \common\models\ChangePassword();
        }
        return $this->render('change_password', [
                    'model' => $model,
                    'user' => $user,
        ]);
    }

    /**
     * Employer Email Verification
     *
     * @return string
     */
    public function actionEmailVerification($token) {

        $user_data = Employer::find()->where(['id' => $token])->one();
        if (!empty($user_data)) {
            if ($user_data->email_varification == 0) {
                $user_data->email_varification = 1;
                $user_data->update();
                $flag = 0;
                Yii::$app->session->setFlash('success', 'Your Email ID has been verified, please login again.');
            } else {
                Yii::$app->session->setFlash('success', 'Your Email ID is already verified, please login to access your profile.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'This Email Varification link is Expired');
            $flag = 0;
        }
        $this->redirect(['/employer/index']);
    }

    /**
     * Lists All Plans When the user not select any plan.Otherwise show the selected plan.
     * @return mixed
     */
    public function actionUserPlans() {
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $user_package = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        $searchModel = new \common\models\UserPlanHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id' => Yii::$app->session['employer_data']['id']]);
        return $this->render('update_user_plans', [
                    'user_package' => $user_package,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Add selected plans into user plans table.
     * @return mixed
     */
    public function actionSelectPlan($id) {
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
        $package = \common\models\Packages::find()->where(['id' => $id])->one();
        $model = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        $old_package = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        if (!empty($model)) {
            $model->package = $package->id;
            $tran_no = $this->GenerateTransactionNo();
            $model->transaction_id = $tran_no;
            $model->start_date = date('Y-m-d');
            $model->end_date = date('Y-m-d', strtotime($model->start_date . ' + ' . ($package->no_of_days - 1) . ' days'));
            $model->no_of_days = $package->no_of_days;
            $model->no_of_days_left = $package->no_of_days;
            $model->package_credit = $package->no_of_downloads;
            $model->no_of_downloads = $package->no_of_downloads + $old_package->no_of_downloads_left;
            $model->no_of_downloads_left = $package->no_of_downloads + $old_package->no_of_downloads_left;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                $this->PlanHistory($model, $old_package);
                Yii::$app->session->setFlash('success', 'Plan selected successfully');
                return $this->redirect(['/employer/user-plans']);
            }
        } else {
            return $this->redirect(['/employer/user-plans']);
        }
    }

    public function GenerateTransactionNo() {
        $last_pack = EmployerPackages::find()->orderBy(['transaction_id' => SORT_DESC])->one();
        if (!empty($last_pack)) {
            $transaction_no = $last_pack->transaction_id + 1;
        } else {
            $transaction_no = 1000;
        }
        return $transaction_no;
    }

    /**
     * Add selected plans into user plans table.
     * @return mixed
     */
    public function PlanHistory($model, $package) {
        $plans = new \common\models\UserPlanHistory();
        $plans->user_id = $package->employer_id;
        $plans->plan = $package->package;
        $plans->start_date = $package->start_date;
        $plans->end_date = $package->end_date;
        $plans->transaction_id = $package->transaction_id;
        $plans->package_credit = $package->no_of_downloads;
        $plans->total_credits = $package->no_of_downloads;
        $plans->remaining_credits = 0;
        $plans->status = 0;
        $plans->save();
        return;
    }

    /**
     * Candidate Cv View.
     * @return mixed
     */
    public function actionViewCv($id) {
        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $candidate_profile = \common\models\CandidateProfile::findOne($id);
        if ($candidate_profile->status == 1) {
            $packages = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
            if (empty($packages)) {
                return $this->redirect(Yii::$app->request->referrer);
                Yii::$app->session->setFlash('error', "You Can't view CVs.Please Select a Package");
            } else {
                $candidate = \common\models\Candidate::findOne($candidate_profile->candidate_id);
                $view_cv = \common\models\CvViewHistory::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'candidate_id' => $id])->one();
                $model = \common\models\CandidateProfile::findOne($id);
                $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $candidate_profile->candidate_id])->all();
                $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $candidate_profile->candidate_id])->all();
                $contact_info = \common\models\Candidate::find()->where(['id' => $candidate_profile->candidate_id])->one();
                if (empty($view_cv)) {
                    if ($packages->end_date >= date('Y-m-d')) {
                        if ($packages->no_of_downloads_left >= 1) {
                            $packages->no_of_downloads_left = $packages->no_of_downloads_left - 1;
                            $packages->update();
                            $this->SaveViewHistory(Yii::$app->session['employer_data']['id'], $id);
                            $this->CandidateEmail($id);
                            Yii::$app->session->setFlash('success', "You have already viewed this profile.No credits deduct from your package.");
                            return $this->render('cv-view', [
                                        'model' => $model,
                                        'model_education' => $model_education,
                                        'model_experience' => $model_experience,
                                        'contact_info' => $contact_info,
                            ]);
                        } else {
                            Yii::$app->session->setFlash('error', "You Can't view CVs.Please Upgrade Your Package");
                            return $this->redirect(Yii::$app->request->referrer);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', "You Can't view CVs.Please Upgrade Your Package");
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                } else {
                    $view_cv->date_of_view = date('Y-m-d');
                    $view_cv->update();
//                    $this->CandidateEmail($id);
//                return $this->redirect(['view-cvs', 'id' => $candidate->user_id]);
                    Yii::$app->session->setFlash('success', "You have already viewed this profile.No credits deduct from your package.");
                    return $this->render('cv-view', [
                                'model' => $model,
                                'model_education' => $model_education,
                                'model_experience' => $model_experience,
                                'contact_info' => $contact_info,
                    ]);
                }
            }
        } else {
            return $this->render('cv-view-error', [
            ]);
        }
    }

    public function actionViewCvs($id) {
        $model = \common\models\CandidateProfile::findOne($id);
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $contact_info = \common\models\Candidate::find()->where(['id' => $id])->one();
        return $this->render('cv-view', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
                    'contact_info' => $contact_info,
        ]);
    }

    public function CandidateEmail($candidate_id) {
        $candidate = \common\models\Candidate::find()->where(['id' => $candidate_id])->one();
        $employer = Employer::find()->where(['id' => Yii::$app->session['employer_data']['id']])->one();
        if (!empty($candidate) && !empty($employer)) {
            $to = $candidate->email;
            $subject = 'CVS Job Notification';

// message
            $message = '
<html>
<head>

  <title>CVS Job Notification</title>
</head>
<body>
  <p>Your CV is viewed. The company details given below.</p></br>
  <table>
  <tr>
  <td>Company Name</td>
  <td>:</td>
  <td>' . $employer->company_name . '</td>
  </tr>
   <tr>
  <td>Company Email</td>
  <td>:</td>
  <td>' . $employer->company_email . '</td>
  </tr>
  <tr>
  <td>Phone Number</td>
  <td>:</td>
  <td>' . $employer->company_phone_number . '</td>
  </tr>
  <tr>
  <td>Address</td>
  <td>:</td>
  <td>' . $employer->address . '</td>
  </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: info@cvsdatabase.com' . "\r\n";

            mail($to, $subject, $message, $headers);
        }
        return true;
        exit;
    }

    public function SaveViewHistory($employer, $candidate) {
        $model = new \common\models\CvViewHistory();
        $model->employer_id = $employer;
        $model->candidate_id = $candidate;
        $model->date_of_view = date('Y-m-d');
        $model->save();
        return;
    }

    public function actionUpgradePackage() {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere([' != ', 'id', 1]);
        return $this->render('user_plans', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetShortList() {
        if (Yii::$app->request->isAjax) {
            $candidate_id = $_POST['candidate_id'];
            $data = $this->renderPartial('_form_short_list', [
                'candidate_id' => $candidate_id,
            ]);
            echo $data;
        }
    }

    public function actionSaveShortlist() {
        if (Yii::$app->request->isAjax) {
            $candidate_id = $_POST['candidate_id'];
            $folder_name = $_POST['folder_name'];
            $model = new \common\models\ShortList();
            if (!empty(Yii::$app->session['employer_data']['id'] && $candidate_id)) {
                $model->candidate_id = $candidate_id;
                $model->employer_id = Yii::$app->session['employer_data']['id'];
                $model->folder_name = $folder_name;
                $model->short_list_date = date('Y-m-d');
                $model->save();
            }
        }
    }

    public function actionUnShortlist($id) {
        $model = ShortList::find()->where(['candidate_id' => $id, 'employer_id' => Yii::$app->session['employer_data']['id']])->one();
        if (!empty($model)) {
            if ($model->delete()) {
                Yii::$app->session->setFlash('success', "CV Unshortlist Successfully.");
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionShortlistFolder($folder = NULL) {
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $searchModel = new \common\models\ShortListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['employer_id' => Yii::$app->session['employer_data']['id']]);
        if (!empty($folder) && $folder != '') {
            $dataProvider->query->andWhere(['folder_name' => $folder]);
        }
        $model_filter = new CvFilter();
        return $this->render('shortlist-folder', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model_filter' => $model_filter,
        ]);
    }

    public function actionQuickDownload($id) {
        $candidate = \common\models\Candidate::find()->where(['id' => $id])->one();
        $model = \common\models\CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_wordview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
            'candidate' => $candidate,
        ]);
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cv.doc");
        echo $content;
        exit;
    }

    public function actionOpenFolder($folder) {
        $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'folder_name' => $folder])->all();
        return $this->render('folder-view', [
                    'model' => $model,
        ]);
    }

    public function actionViewFolderCvs($id) {
        $candidate = \common\models\Candidate::find()->where(['user_id' => $id])->one();
        $model = \common\models\CandidateProfile::findOne($candidate->id);
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $candidate->id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $candidate->id])->all();

        return $this->render('cv-view', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
                    'candidate' => $candidate,
        ]);
    }

    public function actionRemoveFolder($folder) {
        $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'folder_name' => $folder])->all();
        if (!empty($model)) {
            foreach ($model as $value) {
                $value->delete();
            }
        }
        return $this->redirect(['shortlist-folder']);
    }

    public function actionGetRenameForm() {
        if (Yii::$app->request->isAjax) {
            $folder_name = $_POST['folder_name'];
            $data = $this->renderPartial('_form_rename_folder', [
                'folder_name' => $folder_name,
            ]);
            echo $data;
        }
    }

    public function actionGetMoveFolder() {
        if (Yii::$app->request->isAjax) {
            $candidate_id = $_POST['candidate_id'];
            $data = $this->renderPartial('_form_move_folder', [
                'candidate_id' => $candidate_id,
            ]);
            echo $data;
        }
    }

    public function actionRenameFolder() {
        if (Yii::$app->request->isAjax) {
            $old_folder_name = $_POST['old_folder_name'];
            $new_folder_name = $_POST['new_folder_name'];
            $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'folder_name' => $old_folder_name])->all();
            if (!empty($model)) {
                foreach ($model as $value) {
                    $value->folder_name = $new_folder_name;
                    $value->update();
                }
            }
        }
    }

    public function actionMoveFolder() {
        if (Yii::$app->request->isAjax) {
            $candidate_id = $_POST['candidate_id'];
            $new_folder_name = $_POST['new_folder_name'];
            $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'candidate_id' => $candidate_id])->one();
            if (!empty($model)) {
                $model->folder_name = $new_folder_name;
                $model->update();
            }
        }
    }

    /*
     * Generate report based on service
     */

    public function actionReports($id) {
        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
        $package_history = \common\models\EmployerPackages::find()->where(['id' => $id])->one();
        $employer = Employer::find()->where(['id' => $package_history->employer_id])->one();
        $package = \common\models\Packages::find()->where(['id' => $package_history->package])->one();
        echo $this->renderPartial('report', [
            'package_history' => $package_history,
            'package' => $package,
            'employer' => $employer,
            'print' => true,
        ]);

        exit;
    }

    public function actionReport($id) {
        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
        $package_history = \common\models\UserPlanHistory::find()->where(['id' => $id])->one();
        $employer = Employer::find()->where(['id' => $package_history->user_id])->one();
        $package = \common\models\Packages::find()->where(['id' => $package_history->plan])->one();
        echo $this->renderPartial('report', [
            'package_history' => $package_history,
            'package' => $package,
            'employer' => $employer,
            'print' => true,
        ]);

        exit;
    }

    public function actionPdfExport($id) {
        // get your HTML raw content without any layouts or scripts
        $candidate = \common\models\Candidate::find()->where(['id' => $id])->one();
        $model = \common\models\CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_pdfview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
            'candidate' => $candidate,
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1 {
            font-size:18px
        }',
            'options' => ['title' => ''],
            'methods' => [
                'SetHeader' => ['Curriculum Vitae'],
                'SetFooter' => [' {
            PAGENO
        }'],
            ]
        ]);
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'application/pdf');
        return $pdf->render();
    }

    /*
     * Generate report based on service
     */

    public function actionWordExport($id) {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cv.doc");
        $candidate = \common\models\Candidate::find()->where(['id' => $id])->one();
        $model = \common\models\CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_wordview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
            'candidate' => $candidate,
        ]);
        echo $content;
        exit;
    }

    /**
     * Finds the Business Partner name.
     * @return businee partner names as array
     */
    public function getLocation() {
//        $city_datas = ArrayHelper::map(\common\models\City::find()->orderBy(['city' => SORT_ASC])->all(), 'id', function($model) {
//                    return common\models\Country::findOne($model['country'])->country_name . ' - ' . $model['city'];
//                }
//        );
        $city_datas = \common\models\City::find()->orderBy(['city' => SORT_ASC])->all();
        $source;
        foreach ($city_datas as $value) {
            $country_data = \common\models\Country::find()->where(['id' => $value->country])->one();
            $source[] = $country_data->country_name . ' - ' . $value->city;
        }
        return $source;
    }

    public function actionResendEmailVerification() {
        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            $user = Employer::find()->where(['email' => $email])->one();
            if (!empty($user)) {
                $this->sendMail($user);
                $data = 1;
            } else {
                $data = 0;
            }
            echo $data;
        }
    }

    public function actionForgot() {
        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            $check_exists = Employer::find()->where(['email' => $email])->one();
            $flag = 0;
            if (!empty($check_exists)) {
                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                //$val = base64_encode($token);
                $val = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);

                $token_model = new \common\models\ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->save();
                $this->sendForgotMail($val, $check_exists);
                $flag = 1;
            } else {
                $flag = 0;
            }
            echo $flag;
        }
    }

    public function tokenGenerator() {



        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function sendForgotMail($val, $model) {

        $to = $model->email;
        $subject = 'Change password';
        $message = $this->renderPartial('forgot_mail', ['model' => $model, 'val' => $val]);
// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'noreplay@cvsdatabase.com";
        mail($to, $subject, $message, $headers);
    }

    public function actionNewPassword($token) {
        $this->layout = 'employer_home';
        $data = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $values = explode('_', $data);
        $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = Employer::find()->where("id = " . $token_exist->user_id)->one();
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                    Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                    $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                    $model->update();
                    $token_exist->delete();
                    $this->redirect('index');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'password mismatch');
                }
            }
            return $this->render('new-password', [
            ]);
        } else {
            Yii::$app->getSession()->setFlash('error', "You can't reset password using this link.Please Try again");
        }
    }

    public function actionPricing() {
        $model = \common\models\Packages::find()->all();
        $this->layout = 'employer_home';
        return $this->render('pricing', [
                    'model' => $model,
        ]);
    }

    public function actionContact() {
        $model = \common\models\Packages::find()->all();
        $this->layout = 'employer_home';
        return $this->render('contact', [
                    'model' => $model,
        ]);
    }

    public function actionBlog() {
        $this->layout = 'employer_home';
        return $this->render('blog', [
        ]);
    }

    public function actionBlogView() {
        $this->layout = 'employer_home';
        return $this->render('blog-view', [
        ]);
    }

    /*
     * Delete Employer profile
     * This function disable employer
     */

    public function actionDeleteProfile() {
        $id = Yii::$app->session['employer_data']['id'];
        $user_details = Employer::find()->where(['id' => $id])->one();
        $user_details->status = 0;
        $user_details->update();
        unset(Yii::$app->session['employer_data']);
        $this->redirect(['/employer/index']);
    }

}
