<?php

namespace app\modules\admin\controllers;

use app\models\CategoryProducts;
use app\modules\admin\components\Controller;

class CatalogController extends Controller
{    
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLinkProduct()
    {
        $link = $this->getProductLink();
        $link->load($_POST);
        $link->save();
        \Yii::$app->session->set('kvNodeId', $link->category_id); // Раскрываем нужную ноду дерева
        return $this->redirect('/cms/catalog/index/');
    }

    public function actionUnlinkProduct( $id )
    {
        $link = $this->getProductLink( $id );
        \Yii::$app->session->set('kvNodeId', $link->category_id); // Раскрываем нужную ноду дерева
        $link->delete();
        return $this->redirect('/cms/catalog/index/');
    }

    public function actionHideProduct( $id )
    {
        $link = $this->getProductLink( $id );
        $link->is_active = $link->is_active ? 0 : 1;
        $link->save();
        \Yii::$app->session->set('kvNodeId', $link->category_id); // Раскрываем нужную ноду дерева
        return $this->redirect('/cms/catalog/index/');
    }

    public function getProductLink($id = null)
    {
        if( empty($id)) {
            $link = new CategoryProducts();
        } else {
            $link = CategoryProducts::findOne( $id );
        }

        return $link;
    }
}
