<?php

namespace app\modules\calculator\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\i18n\Formatter;
use yii\web\HttpException;
use app\controllers\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\CalcMode;
use app\models\CalcModificationsGroups;
use app\models\CalcSettings;

class DefaultController extends Controller
{

    public function actionIndex()
    {
        $settings = CalcSettings::findOne(0);
        $data = Yii::$app->request->post();
        
        if($data) {
            sleep(10);
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
}
