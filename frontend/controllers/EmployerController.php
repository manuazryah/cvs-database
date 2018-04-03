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
use common\models\CandidateProfileSearch;
use common\models\CvFilter;
use yii\db\Expression;

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

    /**
     * Lists all Employer models.
     * @return mixed
     */
    public function actionIndex() {
        if (!empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] != '') {
            return $this->redirect(array('employer/home'));
        }
        $this->layout = 'employer_login_dashboard';
        $model = new Employer();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->SetValues->setLoginHistory(Yii::$app->session['employer_data']['id'], 3);
            return $this->redirect(array('employer/home'));
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays a single Employer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
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

    public function addPackage($data) {
        $package = \common\models\Packages::findOne(1);
        $model = new EmployerPackages();
        $model->employer_id = $data->id;
        $model->package = $package->id;
        $model->start_date = date('Y-m-d');
        $model->end_date = date('Y-m-d', strtotime($model->start_date . ' + ' . ($package->no_of_days - 1) . ' days'));
        $model->no_of_days = $package->no_of_days;
        $model->no_of_days_left = $package->no_of_days;
        $model->no_of_views = $package->no_of_profile_view;
        $model->no_of_views_left = $package->no_of_profile_view;
        $model->no_of_downloads = $package->no_of_downloads;
        $model->no_of_downloads_left = $package->no_of_downloads;
        $model->created_date = date('Y-m-d');
        if ($model->save()) {
            $this->PlanHistory($model, $package);
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
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'info@eazycheque.com";
        mail($to, $subject, $message, $headers);
        return true;
    }

    public function actionHome() {
        if (empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] == '') {
            return $this->redirect(array('employer/index'));
        }
        $searchModel = new CandidateProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $user_plans = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        $model = new CvSearch();
        $model_filter = new CvFilter();
        if ($model_filter->load(Yii::$app->request->post())) {
            if ($model_filter->keyword != '') {
                $dataProvider->query->andWhere(['title' => $model_filter->keyword]);
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
        }
        return $this->render('dashboard', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'model_filter' => $model_filter,
                    'user_plans' => $user_plans,
        ]);
    }

    public function getFilterJobStatus($data) {
        $cv_data = [];
        $str = implode(", ", $data->job_status);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `job_status`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterLanguage($data) {
        $cv_data = [];
        $str = implode(", ", $data->language);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `languages_known`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterGender($data) {
        $cv_data = [];
        $str = implode(", ", $data->gender);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `gender`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterSalaryRange($data) {
        $cv_data = [];
        $str = implode(", ", $data->salary_range);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `expected_salary`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterJobType($data) {
        $cv_data = [];
        $str = implode(", ", $data->job_types);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `job_type`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterSkills($data) {
        $cv_data = [];
        $str = implode(", ", $data->skills);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `skill`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getFilterIndustry($data) {
        $cv_data = [];
        $str = implode(", ", $data->industries);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `industry`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
    }

    public function getLocations($data) {
        $country_data = [];
        $city_data = [];
        $cv_data = [];
        $countries = \common\models\Country::find()->select('id')->where(['country_name' => $data])->all();
        if (!empty($countries)) {
            foreach ($countries as $country) {
                $country_data[] = $country->id;
            }
        }
        $cities = \common\models\City::find()->where(['city' => $data])->all();
        if (!empty($cities)) {
            foreach ($cities as $city) {
                $city_data[] = $city->id;
            }
        }
        $query1 = \common\models\CandidateProfile::find()->select('id')->where(['nationality' => $country_data])->orWhere(['current_country' => $country_data])->all();
        $query2 = \common\models\CandidateProfile::find()->select('id')->where(['current_city' => $city_data])->all();
        if (!empty($query1)) {
            foreach ($query1 as $query1_data) {
                $cv_data[] = $query1_data->id;
            }
        }
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
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
        Yii::$app->user->logout();
        unset(Yii::$app->session['log-history']);
        unset(Yii::$app->session['employer_data']);
        return $this->redirect(['/site/index']);
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
            $user_data->email_varification = 1;
            $user_data->update();
            $flag = 0;
            Yii::$app->session->setFlash('success', 'your email id verified');
        } else {
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
        if (!empty($model)) {
            $model->package = $package->id;
            $model->start_date = date('Y-m-d');
            $model->end_date = date('Y-m-d', strtotime($model->start_date . ' + ' . ($package->no_of_days - 1) . ' days'));
            $model->no_of_days = $package->no_of_days;
            $model->no_of_days_left = $package->no_of_days;
            $model->no_of_views = $package->no_of_profile_view;
            $model->no_of_views_left = $package->no_of_profile_view;
            $model->no_of_downloads = $package->no_of_downloads;
            $model->no_of_downloads_left = $package->no_of_downloads;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                $this->PlanHistory($model, $package);
                Yii::$app->session->setFlash('success', 'Plan selected successfully');
                return $this->redirect(['/employer/user-plans']);
            }
        } else {
            return $this->redirect(['/employer/user-plans']);
        }
    }

    /**
     * Add selected plans into user plans table.
     * @return mixed
     */
    public function PlanHistory($model, $package) {
        $plans = new \common\models\UserPlanHistory();
        $plans->user_id = $model->employer_id;
        $plans->plan = $package->id;
        $plans->start_date = $model->start_date;
        $plans->end_date = $model->end_date;
        $plans->save();
        return;
    }

    /**
     * Candidate Cv View.
     * @return mixed
     */
    public function actionViewCv($id) {
        $packages = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        if (empty($packages)) {
            return $this->redirect(Yii::$app->request->referrer);
            Yii::$app->session->setFlash('error', "You Can't view CVs.Please Select a Package");
        } else {
            $view_cv = \common\models\CvViewHistory::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'candidate_id' => $id])->one();
            if (empty($view_cv)) {
                if ($packages->end_date >= date('Y-m-d')) {
                    if ($packages->no_of_views_left >= 1) {
                        $packages->no_of_views_left = $packages->no_of_views_left - 1;
                        $packages->update();
                        $this->SaveViewHistory(Yii::$app->session['employer_data']['id'], $id);
                        return $this->redirect(['view-cvs', 'id' => $id]);
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
                return $this->redirect(['view-cvs', 'id' => $id]);
            }
        }
    }

    public function SaveViewHistory($employer, $candidate) {
        $model = new \common\models\CvViewHistory();
        $model->employer_id = $employer;
        $model->candidate_id = $candidate;
        $model->date_of_view = date('Y-m-d');
        $model->save();
        return;
    }

    public function actionViewCvs($id) {
        $model = \common\models\CandidateProfile::findOne($id);
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();

        return $this->render('cv-view', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
        ]);
    }

    public function actionUpgradePackage() {
        $searchModel = new PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['!=', 'id', 1]);
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

    public function actionShortlistFolder() {
        $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->groupBy('folder_name')->all();
        return $this->render('shortlist-folder', [
                    'model' => $model,
        ]);
    }

    public function actionQuickDownload($id) {
        $packages = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        if (!empty($packages)) {
            if ($packages->no_of_downloads_left > 0 && $packages->no_of_downloads_left != '') {
                $packages->no_of_downloads_left = $packages->no_of_downloads_left - 1;
                $packages->update();
                $model = \common\models\CandidateProfile::find()->where(['candidate_id' => $id])->one();
                $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
                $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();
                $content = $this->renderPartial('_wordview', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
                ]);
                header("Content-type: application/vnd.ms-word");
                header("Content-Disposition: attachment;Filename=cv.doc");
                echo $content;
                exit;
            } else {
                Yii::$app->session->setFlash('error', "You Can't download CVs.Please Upgrade Your Package");
                return $this->redirect(Yii::$app->request->referrer);
            }
        } else {
            Yii::$app->session->setFlash('error', "You Can't download CVs.Please Upgrade Your Package");
            return $this->redirect(Yii::$app->request->referrer);
        }
    }

    public function actionOpenFolder($folder) {
        $model = \common\models\ShortList::find()->where(['employer_id' => Yii::$app->session['employer_data']['id'], 'folder_name' => $folder])->all();
        return $this->render('folder-view', [
                    'model' => $model,
        ]);
    }

    public function actionViewFolderCvs($id) {
        $model = \common\models\CandidateProfile::findOne($id);
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $id])->all();

        return $this->render('cv-view', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
        ]);
    }

}
