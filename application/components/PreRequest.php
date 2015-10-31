<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 10.10.2015
 * Time: 20:17
 */

namespace app\components;
use Yii;


class PreRequest
{
    public static function control()
    {
        $status_code = 302;

        $app = Yii::$app;
        $pathInfo = $app->request->pathInfo;
        $suffix = $app->urlManager->suffix;
        $allowRedirect = false;
        $destination = $pathInfo;

        $rule = \app\models\RedirectRules::getSource($pathInfo);
        if($rule) {
            $allowRedirect = true;
            $destination = $rule->getDestination();
        }

        if(!empty($pathInfo) && substr($pathInfo, -1) !== $suffix) {
            $allowRedirect = true;
            $destination = $pathInfo . $suffix;
        }

        if ($allowRedirect) {
            $app->response->redirect('/' . $destination, $status_code);
        }
    }
} 