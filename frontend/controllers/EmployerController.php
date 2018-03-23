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

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (!empty(Yii::$app->session['employer_data']) && Yii::$app->session['employer_data'] != '') {
            return $this->redirect(array('employer/home'));
        }
        return true;
    }

    /**
     * Lists all Employer models.
     * @return mixed
     */
    public function actionIndex() {
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
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->isNewRecord) {
                $model->password = Yii::$app->security->generatePasswordHash($model->password);
            }
            if ($model->validate() && $model->save()) {
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

    public function sendMail($model) {
        $to = $model->email;
        $subject = 'Email verification';
        echo $message = '
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
  text-decoration: none; background-image: -webkit-linear-gradient(top, #3498db, #2980b9); background-image: -moz-linear-gradient(top, #3498db, #2980b9);background-image: -ms-linear-gradient(top, #3498db, #2980b9);background-image: -o-linear-gradient(top, #3498db, #2980b9);background-image: linear-gradient(to bottom, #3498db, #2980b9);-webkit-border-radius: 28;-moz-border-radius: 28;" href="' . Yii::$app->homeUrl . 'employer/email-verification?token=' . $model->id . '" >Click here</a></td>
    </tr>

  </table>
<p> For any queries/ support kindly email to info@cvdatabase.com</p>
</body>
</html>
';
        exit;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'info@eazycheque.com";
        mail($to, $subject, $message, $headers);
        return true;
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

}
