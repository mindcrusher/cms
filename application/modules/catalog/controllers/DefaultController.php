<?php

namespace app\modules\catalog\controllers;

use app\models\Category;
use app\models\Products;
use Yii;
use app\components\Controller;
use app\models\CalcMode;
use app\models\CalcModificationsGroups;
use app\models\CalcSettings;
use yii\data\ActiveDataProvider;



class DefaultController extends Controller
{
    const PAGE_SIZE = 20;

    public function actionIndex()
    {
        $this->actionCategory();
    }

    public function actionCategory( $slug = null)
    {
        $condition = empty( $slug ) ? 1 : ['slug' => $slug];
        $category = Category::findOne( $condition );

        $dataProvider = new ActiveDataProvider([
            'query' => $category->getProducts(),
            'pagination' => [
                'pageSize' => self::PAGE_SIZE,
            ],
        ]);
        return $this->render('category', [
            'category' => $category,
            'products' => $dataProvider
        ]);
    }

    public function actionProduct( $slug )
    {
        $product = Products::findOne( ['slug' => $slug] );

        return $this->render('product', [
            'model' => $product,
        ]);
    }
}
