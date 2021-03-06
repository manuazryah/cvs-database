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
                'only' => ['logout', 'signup', 'resend-email-varification', 'forgot', 'new-password'],
                'rules' => [
                    [
                        'actions' => ['signup', 'resend-email-varification', 'forgot', 'new-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'resend-email-varification', 'forgot', 'new-password'],
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
                    Yii::$app->session->setFlash('success', 'Thank you for registering with us.. a mail has been sent to your mail id (check your spam folder too)');
                    $model_register = new \common\models\CandidateRegister();
                    $flag = 1;
                }
            } else {
                $flag = 0;
            }
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                $candidate = Candidate::findOne(Yii::$app->session['candidate']['id']);
                $candidate->last_login = date('Y-m-d h:i:s');
                $candidate->save();
                Yii::$app->SetValues->setLoginHistory(Yii::$app->session['candidate']['id'], 2);
                return $this->redirect(['candidate/index']);
            } else {
                if (isset(Yii::$app->session['log-err']) && Yii::$app->session['log-err'] == 1) {
                    $stat = 1;
                    unset(Yii::$app->session['log-err']);
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
        $to = $model->email;
        $message = Yii::$app->mailer->compose('candidate_varification_mail', ['model' => $model])
                ->setFrom('noreply@cvsdatabase.com')
                ->setTo($to)
                ->setSubject('Email Varification');
        $message->send();
        return true;
    }

    public function actionEmailVerification($token) {
        $token = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $user_data = Candidate::find()->where(['id' => $token])->one();
        if ($user_data->email_varification_status == 1) {
            
        }
        if (!empty($user_data)) {
            if ($user_data->email_varification_status == 0) {
                $user_data->email_varification_status = 1;
                $user_data->update();
                $flag = 1;
                Yii::$app->session->setFlash('success', 'Your Email ID has been verified, please login again.');
            } else {
                Yii::$app->session->setFlash('success', 'Your Email ID is already verified, please login to access your profile.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'This Email Varification link is Expired');
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

    public function actionForgot() {
        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            $check_exists = Candidate::find()->where(['email' => $email])->one();
            $flag = 0;
            if (!empty($check_exists)) {
                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                //$val = base64_encode($token);
                $val = Yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);

                $token_model = new \common\models\ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->save();
                $this->sendForgotMail($val, $check_exists);
                $flag = 1;
            } else {
                $flag = 0;
            }
            echo $flag;
        }
    }

    public function sendForgotMail($val, $model) {
        $to = $model->email;
        $message = Yii::$app->mailer->compose('forgot_jobseeker_mail', ['model' => $model, 'val' => $val]) // a view rendering result becomes the message body here
                ->setFrom('noreply@cvsdatabase.com')
                ->setTo($to)
                ->setSubject('Change password');
        $message->send();
    }

    public function tokenGenerator() {
        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function actionNewPassword($token) {
        $data = Yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $values = explode('_', $data);
        $token_exist = \common\models\ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = Candidate::find()->where("id = " . $token_exist->user_id)->one();
            if (Yii::$app->request->post()) {
                if (Yii::$app->request->post('new-password') == Yii::$app->request->post('confirm-password')) {
                    Yii::$app->getSession()->setFlash('success', 'password changed successfully');
                    $model->password = Yii::$app->security->generatePasswordHash(Yii::$app->request->post('confirm-password'));
                    $model->update();
                    $token_exist->delete();
                    $this->redirect('index');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'password mismatch');
                }
            }
            return $this->render('forgotpassword', [
            ]);
        } else {
            Yii::$app->getSession()->setFlash('error', "You can't reset password using this link.Please Try again");
        }
    }

    public function actionPrivacyPolicy() {
        return $this->render('privacy_policy');
    }

    public function actionConditions() {
        return $this->render('conditions');
    }

}
