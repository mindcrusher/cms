<?php

namespace app\modules\admin\controllers;

use app\modules\admin\components\Controller;

class CatalogController extends Controller
{    
    public function actionIndex()
    {
        return $this->render('index');
    }
}
