<?php

namespace backend\modules\employer\controllers;

use Yii;
use common\models\EmployerPackages;
use common\models\EmployerPackagesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployerPackagesController implements the CRUD actions for EmployerPackages model.
 */
class EmployerPackagesController extends Controller {

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
     * Lists all EmployerPackages models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new EmployerPackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmployerPackages model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $user_package = $this->findModel($id);
        $searchModel = new \common\models\UserPlanHistorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['user_id' => $user_package->employer_id]);
        return $this->render('view', [
                    'user_package' => $user_package,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new EmployerPackages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new EmployerPackages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing EmployerPackages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->end_date = date("Y-m-d", strtotime($model->end_date));
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing EmployerPackages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmployerPackages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmployerPackages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = EmployerPackages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpgradePackage($emp_id) {
        $searchModel = new \common\models\PackagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['!=', 'id', 1]);
        return $this->render('user_plans', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'emp_id' => $emp_id,
        ]);
    }

    /**
     * Add selected plans into user plans table.
     * @return mixed
     */
    public function actionSelectPlan($id, $emp_id) {
        $id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $id);
        $emp_id = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $emp_id);
        $package = \common\models\Packages::find()->where(['id' => $id])->one();
        $model = EmployerPackages::find()->where(['employer_id' => $emp_id])->one();
        $old_package = EmployerPackages::find()->where(['employer_id' => $emp_id])->one();
        if (!empty($model)) {
            $model->package = $package->id;
            $model->start_date = date('Y-m-d');
            $model->end_date = date('Y-m-d', strtotime($model->start_date . ' + ' . ($package->no_of_days - 1) . ' days'));
            $model->no_of_days = $package->no_of_days;
            $model->no_of_days_left = $package->no_of_days;
            $model->no_of_downloads = $package->no_of_downloads;
            $model->no_of_downloads_left = $package->no_of_downloads;
            $model->created_date = date('Y-m-d');
            if ($model->save()) {
                $this->PlanHistory($model, $old_package);
                Yii::$app->session->setFlash('success', 'Plan selected successfully');
                return $this->redirect(['/employer/employer-packages/index']);
            }
        } else {
            return $this->redirect(['/employer/employer-packages/index']);
        }
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
        $plans->total_credits = $package->no_of_downloads;
        $plans->remaining_credits = $package->no_of_downloads_left;
        $plans->status = 0;
        $plans->save();
        return;
    }

    /*
     * Generate report based on service
     */

    public function actionReport($id) {
        $package_history = \common\models\UserPlanHistory::find()->where(['id' => $id])->one();
        $employer = \common\models\Employer::find()->where(['id' => $package_history->user_id])->one();
        $package = \common\models\Packages::find()->where(['id' => $package_history->plan])->one();
        echo $this->renderPartial('report', [
            'package_history' => $package_history,
            'package' => $package,
            'employer' => $employer,
            'print' => true,
        ]);

        exit;
    }

}
