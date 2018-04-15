<?php

namespace backend\modules\candidate\controllers;

use Yii;
use common\models\Candidate;
use common\models\CvFilter;
use common\models\CandidateProfileSearch;
use common\models\EmployerPackages;
use common\models\CvSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CandidateProfile;
use common\models\CandidateEducation;
use common\models\WorkExperiance;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Candidate models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CandidateProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status' => 1]);
        $user_plans = EmployerPackages::find()->where(['employer_id' => Yii::$app->session['employer_data']['id']])->one();
        $model = new CvSearch();
        $model_filter = new CvFilter();
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
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
                    'model_filter' => $model_filter,
                    'user_plans' => $user_plans,
        ]);
    }

    /**
     * Displays a single Candidate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $candidate = $this->findModel($id);
        $model = \common\models\CandidateProfile::findOne($candidate->id);
        $model_education = \common\models\CandidateEducation::find()->where(['candidate_id' => $candidate->id])->all();
        $model_experience = \common\models\WorkExperiance::find()->where(['candidate_id' => $candidate->id])->all();

        return $this->render('view', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
                    'candidate' => $candidate,
        ]);
    }

    /**
     * Creates a new Candidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Candidate();
        $model->scenario = 'create-admin';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->password = Yii::$app->security->generatePasswordHash($model->password);
            $model->email_varification_status = 1;
            if ($model->save()) {
                $model->user_id = sprintf("%05s", $model->id);
                $model->update();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->scenario = 'create-admin';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Candidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Candidate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Candidate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Candidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdateProfile($id) {
        $user = Candidate::findOne($id);
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        if (empty($model)) {
            $model = new CandidateProfile();
            $photo_ = '';
            $cv_ = '';
        } else {
            $photo_ = $model->photo;
            $cv_ = $model->upload_resume;
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->candidate_id = $id;
            $data = Yii::$app->request->post();
            $this->SetDatas($model);
            $files = UploadedFile::getInstance($model, 'photo');
            $files_resume = UploadedFile::getInstance($model, 'upload_resume');
            if (empty($files)) {
                $model->photo = $photo_;
            } else {
                $model->photo = $files->extension;
            }
            if (empty($files_resume)) {
                $model->upload_resume = $cv_;
            } else {
                $model->upload_resume = $files_resume->extension;
            }
            if ($model->validate() && $model->save()) {
                if (!empty($files)) {
                    $this->upload($model, $files);
                }
                if (isset($files_resume) && !empty($files_resume)) {
                    $files_resume->saveAs(Yii::$app->basePath . '/../uploads/candidate/resume/' . $model->id . '.' . $files_resume->extension);
                }
                $this->AddAcadamics($model, $data);
                $this->AcadamicsUpdate($model, $data);
                $this->AddExperiences($model, $data);
                $this->ExperienceUpdate($model, $data);
                $this->CalculateTotalExperience($model);
            }
        }
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
        if (empty($model_education)) {
            $model_education = new CandidateEducation();
        }
        if (empty($model_experience)) {
            $model_experience = new WorkExperiance();
        }
        return $this->render('update-profile', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
                    'user' => $user,
        ]);
    }

    /**
     * Upload Material photos.
     * @return mixed
     */
    public function Upload($model, $files) {
        if (isset($files) && !empty($files)) {
            $files->saveAs(Yii::$app->basePath . '/../uploads/candidate/profile_picture/' . $model->id . '.' . $files->extension);
        }
        return TRUE;
    }

    public function CalculateTotalExperience($model) {
        $model_experiences = \common\models\WorkExperiance::find()->where(['candidate_id' => $model->candidate_id])->all();
        $tot_diff = 0;
        $tot_experience = 0;
        foreach ($model_experiences as $experiences) {
            $date1 = $experiences->from_date;
            $date2 = $experiences->to_date;

            $ts1 = strtotime($date1);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $tot_diff += (($year2 - $year1) * 12) + ($month2 - $month1);
        }
        if ($tot_diff > 0) {
            $tot_experience = $tot_diff / 12;
        }
        $model->total_experience = sprintf('%0.2f', $tot_experience);
        $model->update();
        return;
    }

    /**
     * Set New Academics Informations into array for saving
     * @return mixed
     */
    public function AddAcadamics($model, $data) {
        if (isset($data['create']) && $data['create'] != '') {
            $create = $data['create'];
            $arr = [];
            $i = 0;
            foreach ($create['course'] as $val) {
                $arr[$i]['course'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['college'] as $val) {
                $arr[$i]['college'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['country'] as $val) {
                $arr[$i]['country'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['from_date'] as $val) {
                $arr[$i]['from_date'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['to_date'] as $val) {
                $arr[$i]['to_date'] = $val;
                $i++;
            }
            $this->SaveAcadamics($arr, $model);
        }
    }

    /**
     * Save New Academics Informations
     * @return mixed
     */
    public function SaveAcadamics($arr, $model) {
        foreach ($arr as $val) {
            $aditional = new CandidateEducation();
            $aditional->candidate_id = $model->candidate_id;
            $aditional->course_name = $val['course'];
            $aditional->collage_university = $val['college'];
            $aditional->country = $val['country'];
            $aditional->from_year = $val['from_date'];
            $aditional->to_year = $val['to_date'];
            if (!empty($aditional->course_name)) {
                $aditional->save();
            }
        }
        return TRUE;
    }

    /**
     * Update Existing Academics Informations
     * @return mixed
     */
    public function AcadamicsUpdate($model, $data) {
        if (isset($data['updatee']) && $data['updatee'] != '') {
            $update = $data['updatee'];
            $arr = [];
            $i = 0;
            foreach ($update as $key => $val) {
                $arr[$key]['course'] = $val['course'][0];
                $arr[$key]['college'] = $val['college'][0];
                $arr[$key]['country'] = $val['country'][0];
                $arr[$key]['from_date'] = $val['from_date'][0];
                $arr[$key]['to_date'] = $val['to_date'][0];
                $i++;
            }
            foreach ($arr as $key => $value) {
                $aditional = CandidateEducation::findOne($key);
                if (!empty($aditional)) {
                    $aditional->course_name = $value['course'];
                    $aditional->collage_university = $value['college'];
                    $aditional->country = $value['country'];
                    $aditional->from_year = $value['from_date'];
                    $aditional->to_year = $value['to_date'];
                    $aditional->save();
                }
            }
        }
        return TRUE;
    }

    /**
     * Ser New Experience Informations into temporary array for saving
     * @return mixed
     */
    public function AddExperiences($model, $data) {
        if (isset($data['expcreate']) && $data['expcreate'] != '') {
            $create = $data['expcreate'];
            $arr = [];
            $i = 0;
            foreach ($create['company_name'] as $val) {
                $arr[$i]['company_name'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['designation'] as $val) {
                $arr[$i]['designation'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['job_responsibility'] as $val) {
                $arr[$i]['job_responsibility'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['from_date'] as $val) {
                $arr[$i]['from_date'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['to_date'] as $val) {
                $arr[$i]['to_date'] = $val;
                $i++;
            }
            $i = 0;
            foreach ($create['country'] as $val) {
                $arr[$i]['country'] = $val;
                $i++;
            }
            $this->SaveExperience($arr, $model);
        }
    }

    /**
     * Save Experience Informations into work experience table
     * @return mixed
     */
    public function SaveExperience($arr, $model) {
        foreach ($arr as $val) {
            $aditional = new WorkExperiance();
            $aditional->candidate_id = $model->candidate_id;
            $aditional->company_name = $val['company_name'];
            $aditional->designation = $val['designation'];
            $aditional->job_responsibility = $val['job_responsibility'];
            $aditional->from_date = $val['from_date'];
            $aditional->to_date = $val['to_date'];
            $aditional->country = $val['country'];
            if (!empty($aditional->company_name)) {
                $aditional->save();
            }
        }
        return TRUE;
    }

    /**
     * Update Existing Experience Informations
     * @return mixed
     */
    public function ExperienceUpdate($model, $data) {
        if (isset($data['expupdatee']) && $data['expupdatee'] != '') {
            $update = $data['expupdatee'];
            $arr = [];
            $i = 0;
            foreach ($update as $key => $val) {
                $arr[$key]['company_name'] = $val['company_name'][0];
                $arr[$key]['designation'] = $val['designation'][0];
                $arr[$key]['job_responsibility'] = $val['job_responsibility'][0];
                $arr[$key]['from_date'] = $val['from_date'][0];
                $arr[$key]['to_date'] = $val['to_date'][0];
                $arr[$key]['country'] = $val['country'][0];
                $i++;
            }
            foreach ($arr as $key => $value) {
                $aditional = WorkExperiance::findOne($key);
                $aditional->company_name = $value['company_name'];
                $aditional->designation = $value['designation'];
                $aditional->job_responsibility = $value['job_responsibility'];
                $aditional->from_date = $value['from_date'];
                $aditional->to_date = $value['to_date'];
                $aditional->country = $value['country'];
                $aditional->save();
            }
        }
        return TRUE;
    }

    /**
     * This Function set candidate id,industry,skills and delivery licenses into model
     * @return mixed
     */
    public function SetDatas($model) {
        if ($model != null) {
            if (isset($model->dob) && $model->dob != '') {
                $model->dob = date("Y-m-d", strtotime($model->dob));
            }
            if (isset($model->industry) && $model->industry != '') {
                $model->industry = implode(",", $model->industry);
            }
            if (isset($model->skill) && $model->skill != '') {
                $model->skill = implode(",", $model->skill);
            }
            if (isset($model->driving_licences) && $model->driving_licences != '') {
                $model->driving_licences = implode(",", $model->driving_licences);
            }
            if (isset($model->languages_known) && $model->languages_known != '') {
                $model->languages_known = implode(",", $model->languages_known);
            }
        }
        return $model;
    }

    /**
     * This function find skills based on industry
     * @return skills
     */
    public function actionGetSkills() {
        if (Yii::$app->request->isAjax) {
            $industries = $_POST['industry'];
            if (!empty($industries) && $industries != '') {
                $skill_datas = \common\models\Skills::find()->where(['in', 'industry', $industries])->all();
                $options = '<option value="">-Choose a Skill-</option>';
                foreach ($skill_datas as $skill_data) {
                    $options .= "<option value='" . $skill_data->id . "'>" . $skill_data->skill . "</option>";
                }
            } else {
                $options = '<option value="">-Choose a Skill-</option>';
            }
            echo $options;
        }
    }

    /**
     * This function find cities based on Country
     * @return countries
     */
    public function actionGetCity() {
        if (Yii::$app->request->isAjax) {
            $country = $_POST['country'];
            if (!empty($country) && $country != '') {
                $country_datas = \common\models\City::find()->where(['country' => $country])->all();
                $options = '<option value="">-Choose a City-</option>';
                foreach ($country_datas as $country_data) {
                    $options .= "<option value='" . $country_data->id . "'>" . $country_data->city . "</option>";
                }
            } else {
                $options = '<option value="">-Choose a City-</option>';
            }
            echo $options;
        }
    }

    /**
     * This function add new row for new academic entry
     * @return new row
     */
    public function actionGetAcadamics() {
        if (Yii::$app->request->isAjax) {
            $course_datas = \common\models\Courses::find()->where(['status' => 1])->all();
            $country_datas = \common\models\Country::find()->where(['status' => 1])->all();
            $new_row = $this->renderPartial('academics_row', [
                'course_datas' => $course_datas,
                'country_datas' => $country_datas,
            ]);
            return $new_row;
        }
    }

    /**
     * This function remove an existing academic entry
     * @return
     */
    public function actionRemoveAcadamics() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $model = CandidateEducation::find()->where(['id' => $id])->one();
            $flag = 0;
            if (!empty($model)) {
                if ($model->delete()) {
                    $flag = 1;
                }
            }
            return $flag;
        }
    }

    /**
     * This function add new row for new work experience entry
     * @return new row
     */
    public function actionGetExperience() {
        if (Yii::$app->request->isAjax) {
            $country_datas = \common\models\Country::find()->where(['status' => 1])->all();
            $new_row = $this->renderPartial('experince_row', [
                'country_datas' => $country_datas,
            ]);
            return $new_row;
        }
    }

    /**
     * This function remove existing work experience entry
     * @return
     */
    public function actionRemoveExperience() {
        if (Yii::$app->request->isAjax) {
            $id = $_POST['id'];
            $model = WorkExperiance::find()->where(['id' => $id])->one();
            $flag = 0;
            if (!empty($model)) {
                if ($model->delete()) {
                    $flag = 1;
                }
            }
            return $flag;
        }
    }

    /*
     * Reset candidate Password
     */

    public function actionResetPassword($id) {
        $model = new \common\models\ChangeCandidatePassword();
        $candidate = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $candidate->password = Yii::$app->security->generatePasswordHash($model->confirm_password);
            if ($candidate->update()) {
                Yii::$app->session->setFlash('success', "Password Changed successfully.");
                $model = new \common\models\ChangeCandidatePassword();
            }
        }
        return $this->render('reset_password', [
                    'model' => $model,
                    'candidate' => $candidate,
        ]);
    }

    /*
     * Add new industry suggetion from candidate side
     */

    public function actionAddIndustry() {
        $model = new \common\models\Industry();
        if (Yii::$app->request->post()) {
            $model->industry_name = Yii::$app->request->post()['industry_name'];
            $model->status = 2;
            if ($model->validate() && $model->save()) {
                echo json_encode(array("con" => "1", 'id' => $model->id, 'name' => $model->industry_name)); //Success
                exit;
            } else {
                $array = $model->getErrors();
                $error = isset($array['name']['0']) ? $array['name']['0'] : 'Internal error';
                echo json_encode(array("con" => "2", 'error' => $error));
                exit;
            }
        }
        return $this->renderAjax('add-industry', [
                    'model' => $model,
        ]);
    }

    /*
     * Add new skills suggetion from candidate side
     */

    public function actionAddSkill() {
        $model = new \common\models\Skills();
        if (Yii::$app->request->post()) {
            $model->industry = Yii::$app->request->post()['industry'];
            $model->skill = Yii::$app->request->post()['skill'];
            $model->status = 2;
            if ($model->validate() && $model->save()) {
                echo json_encode(array("con" => "1", 'id' => $model->id, 'name' => $model->skill)); //Success
                exit;
            } else {
                $array = $model->getErrors();
                $error = isset($array['name']['0']) ? $array['name']['0'] : 'Internal error';
                echo json_encode(array("con" => "2", 'error' => $error));
                exit;
            }
        }
        return $this->renderAjax('add-skill', [
                    'model' => $model,
        ]);
    }

    public function actionDisableProfile($id) {
        $user_details = Candidate::find()->where(['id' => $id])->one();
        $user_details->status = 0;
        $user_details->update();
        $this->redirect(['/candidate/candidate/index']);
    }

    public function actionPdfExport($id) {
        // get your HTML raw content without any layouts or scripts
        $candidate = $this->findModel($id);
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
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
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => ''],
            'methods' => [
                'SetHeader' => ['Curriculum Vitae'],
                'SetFooter' => ['{PAGENO}'],
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
        $candidate = $this->findModel($id);
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_wordview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
            'candidate' => $candidate,
        ]);
        echo $content;
        exit;
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
                $cv_data[] = $ind_val['candidate_id'];
            }
        }

        $candidate_reference = \common\models\Candidate::find()->where(['user_id' => $data])->one();
        if (!empty($candidate_reference)) {
            $arr[] = $candidate_reference['id'];
        }
        if (!empty($arr)) {
            $str = implode(", ", $arr);
            $result2 = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `candidate_id`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
            if (!empty($result2)) {
                foreach ($result2 as $ind_val) {
                    $cv_data[] = $ind_val['id'];
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
                        ->where(['>=', 'total_experience', 1])
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
                        ->where(['>=', 'total_experience', 2])
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
                        ->where(['>=', 'total_experience', 5])
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
                        ->where(['>=', 'total_experience', 10])
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
                        ->where(['>=', 'total_experience', 15])
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
        $str = implode(", ", $data->nationality);
        $result = Yii::$app->db->createCommand("select * from candidate_profile WHERE CONCAT(',', `nationality`, ',') REGEXP ',([" . $str . "]),'")->queryAll();
        if (!empty($result)) {
            foreach ($result as $ind_val) {
                $cv_data[] = $ind_val['id'];
            }
        }
        return $cv_data;
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

}
