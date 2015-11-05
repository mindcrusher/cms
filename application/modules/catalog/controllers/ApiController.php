<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 08.03.2015
 * Time: 0:28
 */

namespace app\modules\catalog\controllers;

use app\models\db\Products;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'app\models\Products';

    public function actionProduct( $id )
    {
        $product = Products::findOne($id);
        $model = [
            'id' => $product->id,
            'title' => $product->title,
            'offers' => $product->getOffersList(),
        ];

        return $model;
    }
}