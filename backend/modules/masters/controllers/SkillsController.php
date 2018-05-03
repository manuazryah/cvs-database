<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\Skills;
use common\models\SkillsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * SkillsController implements the CRUD actions for Skills model.
 */
class SkillsController extends Controller {
    
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
     * Lists all Skills models.
     * @return mixed
     */
    public function actionIndex($id = null) {
        $searchModel = new SkillsSearch();
        if (isset($id) && $id != '')
            $model = $this->findModel($id);
        else
            $model = new Skills();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->save()) {
            if (isset($id) && $id != '')
                Yii::$app->session->setFlash('success', "Updated Successfully");
            else
                Yii::$app->session->setFlash('success', "Skills created Successfully");
            $model = new Skills();
            return $this->redirect(['index']);
        }
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    /**
     * Displays a single Skills model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Skills model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Skills();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Skills model.
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
     * Deletes an existing Skills model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $skill_exists = \common\models\CandidateProfile::find()->where(new Expression('FIND_IN_SET(:skill, skill)'))->addParams([':skill' => $id])->exists();
        if (empty($skill_exists)) {
            $this->findModel($id)->delete();
            Yii::$app->session->setFlash('success', "Skill Removed Successfully");
        } else {
            Yii::$app->session->setFlash('error', "Can't remove bacause this skill is already in use.");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Skills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Skills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Skills::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
