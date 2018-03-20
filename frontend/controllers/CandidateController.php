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
        if (empty(Yii::$app->session['candidate'])) {
            return $this->redirect(array('site/index'));
        }
        $searchModel = new CandidateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
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
        $model = CandidateProfile::find()->where(['candidate_id' => $id])->one();
        $model_education = CandidateEducation::find()->where(['candidate_id' => $id])->all();
        if (empty($model)) {
            $model = new CandidateProfile();
        }
        if (empty($model)) {
            $model_education = new CandidateEducation();
        }
        if ($model->load(Yii::$app->request->post())) {
            $this->SetDatas($model);
            if ($model->validate() && $model->save()) {

            }
        } return $this->render('update', [
                    'model' => $model,
                    'model_education' => $model_education,
        ]);
    }

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

    public function actionLogout() {
        unset(Yii::$app->session['candidate']);
        return $this->redirect(['site/index']);
    }

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

}
