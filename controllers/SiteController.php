<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\LoginForm;
use app\models\ForgotForm;
use app\models\ResetForm;
use app\models\LoginUser;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['forgot', 'reset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ]
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
     * @return string
     */
    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionForgot() {
        $model = new ForgotForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail($model->email)) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry , we are unable to reset your password for the email u sprovided at the moment , please try again later');
            }
        }
        return $this->render('forgot', ['model' => $model]);
    }

    public function actionReset() {
        $model = new ResetForm();
        $token = Yii::$app->getRequest()->getQueryParam('token');
        $user = LoginUser::find()->where(['token' => $token])->one();
        if ($user == NULL || $user->expiredate < time()) {
            Yii::$app->session->setFlash('error', 'Sorry , the link for reset password is wrong , please try again ');
            return $this->redirect(Yii::$app->urlManager->createUrl(["site/forgot"]));
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->Reset($user)) {
                Yii::$app->session->setFlash('success', 'Your password is reset successfuly');
                return $this->redirect(Yii::$app->urlManager->createUrl(["site/index"]));
            } else {
                Yii::$app->session->setFlash('error', 'Sorry , we are unable to reset your password, please try again ');
            }
        }
        return $this->render('reset', ['model' => $model]);
    }

}
