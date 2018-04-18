<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Candidate;
use common\models\LoginHistory;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'resend-email-varification'],
                'rules' => [
                        [
                        'actions' => ['signup', 'resend-email-varification'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $model_register = new \common\models\CandidateRegister();
        $model = new Candidate();
        $model->scenario = 'login';
        $flag = 1;
        $stat = 0;
        if ($model_register->load(Yii::$app->request->post())) {
            if ($model_register->validate()) {
                $model_register->password = Yii::$app->security->generatePasswordHash($model_register->password);
                $model_register->password_repeat = $model_register->password;
                $model_register->review_status = 0;
                if ($model_register->save()) {
                    $model_register->user_id = sprintf("%05s", $model_register->id);
                    $model_register->update();
                    $this->sendMail($model_register);
                    Yii::$app->session->setFlash('success', 'Thanku for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
                    $model_register = new Candidate();
                    $flag = 1;
                }
            } else {
                $flag = 0;
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                Yii::$app->SetValues->setLoginHistory(Yii::$app->session['candidate']['id'], 2);
                return $this->redirect(['candidate/update-profile']);
            } else {
                if ($model->email_varification_status == 0) {
                    $stat = 1;
                }
                $flag = 1;
            }
        }
        return $this->render('index', [
                    'model' => $model,
                    'model_register' => $model_register,
                    'flag' => $flag,
                    'stat' => $stat,
        ]);
    }

    public function actionEmployer() {
        $this->layout = 'employer_home';
        return $this->render('employer', [
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {

            $model->password = '';
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    public function sendMail($model) {

//        echo '<a href="' . Yii::$app->homeUrl . 'site/new-password?token=' . $val . '">Click here change password</a>';
//        exit;
        $to = $model->email;

// subject
        $subject = 'Email verification';

// message
        $message = '
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
  text-decoration: none; background-image: -webkit-linear-gradient(top, #3498db, #2980b9); background-image: -moz-linear-gradient(top, #3498db, #2980b9);background-image: -ms-linear-gradient(top, #3498db, #2980b9);background-image: -o-linear-gradient(top, #3498db, #2980b9);background-image: linear-gradient(to bottom, #3498db, #2980b9);-webkit-border-radius: 28;-moz-border-radius: 28;" href="http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'site/email-verification?token=' . Yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->id) . '" >Click here</a></td>
    </tr>

  </table>
<p> For any queries/ support kindly email to info@cvdatabase.com</p>
</body>
</html>
';
//        exit;
// To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n" .
                "From: 'info@eazycheque.com";
        mail($to, $subject, $message, $headers);
        return true;
    }

    public function actionEmailVerification($token) {
        $token = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $user_data = Candidate::find()->where(['id' => $token])->one();
        if ($user_data->email_varification_status == 1) {

        }
        if (!empty($user_data)) {
            $user_data->email_varification_status = 1;
            $user_data->update();
            $flag = 1;
            Yii::$app->session->setFlash('success', 'Your Email ID has been verified, please login again.');
        } else {
            Yii::$app->session->setFlash('success', 'This Email Varification link is Expired');
            $flag = 1;
        }
        $this->redirect('index');
    }

    public function actionResendEmailVarification() {
        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            $user = Candidate::find()->where(['email' => $email])->one();
            if (!empty($user)) {
                $this->sendMail($user);
                $data = 1;
            } else {
                $data = 0;
            }
            echo $data;
        }
    }

}
