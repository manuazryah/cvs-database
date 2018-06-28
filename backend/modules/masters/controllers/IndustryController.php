<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\Industry;
use common\models\IndustrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * IndustryController implements the CRUD actions for Industry model.
 */
class IndustryController extends Controller {
    
    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
            return false;
        }
        if (Yii::$app->session['post']['masters'] != 1) {
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
//                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Industry models.
     * @return mixed
     */
    public function actionIndex($id = null) {
        $searchModel = new IndustrySearch();
        if (isset($id) && $id != '')
            $model = $this->findModel($id);
        else
            $model = new Industry();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            if (isset($id) && $id != '')
                Yii::$app->session->setFlash('success', "Updated Successfully");
            else
                Yii::$app->session->setFlash('success', "Industry created Successfully");
            $model = new Industry();
            return $this->redirect(['index']);
        }
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Industry model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Industry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Industry();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Industry model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Industry model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $industry_exists = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:industry, industry)'))->addParams([':industry' => $id])->all();
        if (empty($industry_exists)) {
            $this->findModel($id)->delete();
        } else {
            foreach ($industry_exists as $value) {
                $industry = explode(',', $value->industry);
                $new_arr =[];
                if(!empty($industry)){
                    foreach ($industry as $val) {
                        if($val != $id){
                            $new_arr[]=$val;
                        }
                    }
                }
                if(!empty($new_arr)){
                    $new_industry = implode(",", $new_arr);
                }else{
                    $new_industry = '';
                }
                $value->industry = $new_industry;
                $value->update();
            }
            $this->findModel($id)->delete();
        }
        Yii::$app->session->setFlash('success', "Industry Removed Successfully");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Industry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Industry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Industry::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionApprove($id) {
        $model = $this->findModel($id);
        if (!empty($model)) {
            $model->status = 1;
            $model->save();
            Yii::$app->session->setFlash('success', "Industry Approved Successfully");
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

}
