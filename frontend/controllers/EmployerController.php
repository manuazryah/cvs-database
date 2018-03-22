<?php

namespace frontend\controllers;

use Yii;
use common\models\Employer;
use common\models\EmployerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(array('employer/home'));
        }
        $this->layout = 'employer_login_dashboard';
        $model = new Employer();
        $model->scenario = 'login';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
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
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isNewRecord) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }
            if ($model->validate() && $model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    public function actionHome() {

        if (Yii::$app->user->isGuest) {
            return $this->redirect(array('employer/index'));
        }
        return $this->render('dashboard');
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
        Yii::$app->user->logout();
        return $this->redirect(['/site/index']);
    }

    /**
     * Change Password.
     *
     * @return string
     */
    public function actionChangePassword() {
        $model = new \common\models\ChangeEmployerPassword();
        $id = Yii::$app->user->identity->id;
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

}
