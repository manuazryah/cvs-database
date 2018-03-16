<?php

namespace backend\modules\admin\controllers;

use Yii;
use common\models\AdminUsers;
use common\models\AdminUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminUsersController implements the CRUD actions for AdminUsers model.
 */
class AdminUsersController extends Controller {

        public function init() {
                if (Yii::$app->user->isGuest)
                        $this->redirect(['/site/index']);

                if (Yii::$app->session['post']['admin'] != 1)
                        $this->redirect(['/site/home']);
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
         * Lists all AdminUsers models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new AdminUsersSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /**
         * Displays a single AdminUsers model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new AdminUsers model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new AdminUsers();
                $model->setScenario('create');
                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model)) {
                        if ($model->isNewRecord) {
                                $model->password = Yii::$app->security->generatePasswordHash($model->password);
                        }
                        if ($model->validate() && $model->save()) {
                                return $this->redirect(['view', 'id' => $model->id]);
                        }
                }
                return $this->render('create', [
                            'model' => $model,
                ]);
        }

        /**
         * Updates an existing AdminUsers model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                }
                return $this->render('update', [
                            'model' => $model,
                ]);
        }

        /**
         * Deletes an existing AdminUsers model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        /**
         * Finds the AdminUsers model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return AdminUsers the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = AdminUsers::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionChangePassword($id) {

                $model = $this->findModel($id);
                if (Yii::$app->request->post()) {
                        if (Yii::$app->getSecurity()->validatePassword(Yii::$app->request->post('old-password'), $model->password)) {

                                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {

                                        Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                                        $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                                        $model->update();
                                        return $this->redirect(Yii::$app->request->referrer);
                                } else {
                                        Yii::$app->getSession()->setFlash('error', 'password mismatch');
                                }
                        } else {

                                Yii::$app->getSession()->setFlash('error', 'incorrect old password');
                        }
                }
                return $this->render('new-password', [
                            'model' => $model,
                ]);
        }

}
