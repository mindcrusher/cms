<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\i18n\Formatter;
use yii\web\HttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CalcMode;
use app\models\CalcModificationsGroups;
use app\models\CalcSettings;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
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

    public function actions()
    {
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

    public function actionIndex()
    {
        $this->layout = '/calc';
        $settings = CalcSettings::findOne(0);
        $data = Yii::$app->request->post();
        
        if($data) {
            $formatter = new Formatter();
            $formatter->thousandSeparator = ' ';

            $base = CalcMode::findOne($data['mode']);
            $price = $base->getPrice(Yii::$app->request->post('mod'));
            header('Content-type: application/json');
            echo Json::encode([
                'price' => $price,
                'message' => '<span class="lead">'.$settings->cost_header.' <span class="text-success">'. $formatter->asDecimal($price).' руб.</span></span>',
            ]);
        } else {
            $settings = CalcSettings::findOne(0);
            $modes = CalcMode::findAll(['is_active' => 1]);
            $modifications = CalcModificationsGroups::find()->with('calcModifications')->all();
            return $this->render('index', [
                'modes' => $modes,
                'modifications' => $modifications,
                'settings'=> $settings,
            ]);
        }
    }
    
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/admin/mode/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) || $model->login()) {
            return $this->redirect(['/admin/mode/index']);
        } else {
            throw new HttpException(403);
            /*
            return $this->render('login', [
                'model' => $model,
            ]);
            */
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
}
