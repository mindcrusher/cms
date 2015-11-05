<?php
namespace app\modules\cart\controllers;

use yii\rest\ActiveController;
use app\models\Offer;

class ApiController extends ActiveController
{
    public $offer;
    public $offer_id;
    public $quantity;
    

    public $modelClass = 'app\models\Offer';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    /**
    * Override the default ActiveControler actions;
    * 
    */
    public function actions()
    {
        return [];
    }
    
    public function actionIndex()
    {
        //\Yii::$app->cart->removeAll();
    }
    
    public function actionClear()
    {
        \Yii::$app->cart->removeAll();
    }
    
    public function actionCreate()
    {
        $offer = $this->loadModel( $this->offer_id );
        \Yii::$app->cart->put($offer, $this->quantity );
    }
    
    public function actionUpdate( $id )
    {
        $offer = $this->loadModel( $id );
        
        \Yii::$app->cart->update($offer, $this->quantity);
    }
    
    
    public function actionDelete( $id )
    {
        $offer = $this->loadModel( $id );
        \Yii::$app->cart->remove($offer);
    }
    
    
    public function loadModel( $id = null )
    {
        if(empty($this->offer)) {
            $this->offer = Offer::findOne($id);
        }

        return $this->offer;
    }
    
    public function beforeAction( $action )
    {
        $params = \Yii::$app->getRequest()->getBodyParams();
        if(!empty($params['cid'])) {
            $this->offer_id = $params['cid'];
        }

        $this->quantity = empty($params['quantity']) ? 1 : abs($params['quantity']);
        
        return parent::beforeAction( $action );
    }
    
    public function afterAction( $action, $result )
    {
        parent::afterAction( $action, $result );
        $response = \Yii::$app->getResponse();
        $response->setStatusCode(200);
        return DefaultController::cartState();
    }
}