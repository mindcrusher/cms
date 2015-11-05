<?php

namespace app\modules\cart\controllers;

use \app\models\db\Offers;
use \yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionDo()
    {
        $request = \Yii::$app->request;
        $cart = \Yii::$app->cart;
        $offer = Offers::findOne(['id' => $request->get('offer_id')]);

        switch( $request->get('action')) {
            case 'add':
                $cart->put($offer, $request->get('quantity'));
                break;
            case 'update':
                $cart->remove($offer);
                $cart->put($offer, $request->get('quantity'));
                break;
            case 'remove':
                $cart->remove($offer);
                break;
        }

        if ( $request->isAjax ) {
            return self::cartState();
        } else {
            $this->redirect(['/cart/default/index/']);
        }
    }

    public static function cartState()
    {
        $cart = \Yii::$app->cart;

        $cartState = [
            'cost' => $cart->getCost(),
            'count' => $cart->getCount(),
            'positions' => [],
        ];

        foreach ($cart->getPositions() as $position) {
            $cartState['positions'][] = [
                'id' => $position->id,
                'title' => $position->product->title,
                'price' => $position->getPrice(),
                'quantity' => $position->getQuantity(),
            ];
        }
        sort($cartState['positions']);
        return $cartState;
    }
}