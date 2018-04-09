<?php

namespace frontend\controllers;

use Yii;
use common\models\Candidate;
use common\models\CandidateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CandidateProfile;
use common\models\CandidateEducation;
use common\models\WorkExperiance;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller {

    public $layout = '@app/views/layouts/candidate_dashboard';

    /**
     * @inheritdoc
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
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (empty(Yii::$app->session['candidate'])) {
            $this->redirect(['/site/index']);
            return false;
        }
        return true;
    }

    /**
     * Lists all Candidate models.
     * @return mixed
     */
    public function actionIndex() {
        $id = Yii::$app->session['candidate']['id'];
        $model = Candidate::findOne($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->save()) {

        }
        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Candidate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Candidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Candidate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateProfile() {
        $id = Yii::$app->session['candidate']['id'];
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
        return $this->render('update', [
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
            $model->candidate_id = Yii::$app->session['candidate']['id'];
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

    /**
     * Logout Candidate and unset candidate session
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->SetValues->updateLoginHistory();
        unset(Yii::$app->session['log-history']);
        unset(Yii::$app->session['candidate']);
        return $this->redirect(['site/index']);
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

    /**
     * Online CV View and contain options for download.
     * @return mixed
     */
    public function actionOnlineCurriculumVitae() {
        $id = Yii::$app->session['candidate']['id'];
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $files = UploadedFile::getInstance($model, 'upload_resume');
            if (isset($files) && !empty($files) && $model->id != '') {
                $model->upload_resume = $files->extension;
                if ($model->update()) {
                    $files->saveAs(Yii::$app->basePath . '/../uploads/candidate/resume/' . $model->id . '.' . $files->extension);
                }
            }
        }
        return $this->render('cv', [
                    'model' => $model,
                    'model_education' => $model_education,
                    'model_experience' => $model_experience,
        ]);
    }

    public function actionPdfExport() {
        // get your HTML raw content without any layouts or scripts
        $id = Yii::$app->session['candidate']['id'];
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_pdfview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
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

    public function actionWordExport() {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=cv.doc");
        $id = Yii::$app->session['candidate']['id'];
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        $model_experience = WorkExperiance::find()->where(['candidate_id' => $id])->all();
        $content = $this->renderPartial('_wordview', [
            'model' => $model,
            'model_education' => $model_education,
            'model_experience' => $model_experience,
        ]);
        echo $content;
        exit;
    }

    /*
     * Reset candidate Password
     */

    public function actionResetPassword() {
        $model = new \common\models\ResetCandidatePassword();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->setFlash('success', "Password Changed successfully.");
        }
        return $this->render('reset_password', [
                    'model' => $model,
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

}
