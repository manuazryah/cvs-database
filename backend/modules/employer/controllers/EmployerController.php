<?php

namespace backend\modules\employer\controllers;

use Yii;
use common\models\Employer;
use common\models\EmployerReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\EmployerPackages;

/**
 * EmployerController implements the CRUD actions for Employer model.
 */
class EmployerController extends Controller {

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        if (Yii::$app->session['post']['employers'] != 1) {
            Yii::$app->getSession()->setFlash('exception', 'You have no permission to access this page');
            $this->redirect(['/site/exception']);
            return false;
        }
        return true;
    }

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
     * Lists all Employer models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmployerReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employer model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /*
     * Unrevied Employer gridview
     */

    public function actionUnreviewedEmployer() {
        $searchModel = new \common\models\EmployerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['review_status' => 0]);

        return $this->render('un-reviewed', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Employer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Employer();
        $model->scenario = 'create';
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isNewRecord) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                $model->email_varification = 1;
            }
            if ($model->validate() && $model->save()) {
                $this->addPackage($model);
                Yii::$app->session->setFlash('success', 'Thanku for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } return $this->render('create', [
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
        $model->no_of_downloads = $package->no_of_downloads;
        $model->no_of_downloads_left = $package->no_of_downloads;
        $model->created_date = date('Y-m-d');
        $model->save();
        return;
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
     * Updates an existing Employer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model->scenario = 'update';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /*
     * Reset Employer Password
     */

    public function actionResetPassword($id) {
        $model = new \common\models\ChangeCandidatePassword();
        $employer = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $employer->password = Yii::$app->security->generatePasswordHash($model->confirm_password);
            if ($employer->update()) {
                Yii::$app->session->setFlash('success', "Password Changed successfully.");
                $model = new \common\models\ChangeCandidatePassword();
            }
        }
        return $this->render('reset_password', [
                    'model' => $model,
                    'employer' => $employer,
        ]);
    }

    /*
     * List Shortlist Folders
     */

    public function actionShortlistFolders($folder = NULL, $id) {
        $searchModel = new \common\models\ShortListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['employer_id' => $id]);
        if (!empty($folder) && $folder != '') {
            $dataProvider->query->andWhere(['folder_name' => $folder]);
        }
        return $this->render('shortlist-folder', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'id' => $id,
        ]);
    }

    /**
     * Deletes an existing Employer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $user_packages = EmployerPackages::find()->where(['employer_id' => $model->id])->one();
            $user_plans = \common\models\UserPlanHistory::find()->where(['user_id' => $model->id])->all();
            $shortlist_folder = \common\models\ShortList::find()->where(['employer_id' => $model->id])->all();
            if (!empty($user_plans)) {
                foreach ($user_plans as $plans) {
                    if (!empty($plans)) {
                        $plans->delete();
                    }
                }
            }
            if (!empty($shortlist_folder)) {
                foreach ($shortlist_folder as $folder) {
                    if (!empty($folder)) {
                        $folder->delete();
                    }
                }
            }
            if (!empty($user_packages)) {
                $user_packages->delete();
            }
            $model->delete();
        }

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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetRenameForm() {
        if (Yii::$app->request->isAjax) {
            $folder_name = $_POST['folder_name'];
            $id = $_POST['id'];
            $data = $this->renderPartial('_form_rename_folder', [
                'folder_name' => $folder_name,
                'id' => $id,
            ]);
            echo $data;
        }
    }

    public function actionRenameFolder() {
        if (Yii::$app->request->isAjax) {
            $old_folder_name = $_POST['old_folder_name'];
            $new_folder_name = $_POST['new_folder_name'];
            $id = $_POST['emp_id'];
            $model = \common\models\ShortList::find()->where(['employer_id' => $id, 'folder_name' => $old_folder_name])->all();
            if (!empty($model)) {
                foreach ($model as $value) {
                    $value->folder_name = $new_folder_name;
                    $value->update();
                }
            }
        }
    }

    public function actionRemoveFolder($id, $folder) {
        $model = \common\models\ShortList::find()->where(['employer_id' => $id, 'folder_name' => $folder])->all();
        if (!empty($model)) {
            foreach ($model as $value) {
                $value->delete();
            }
        }
        return $this->redirect(['shortlist-folders', 'id' => $id]);
    }

}
