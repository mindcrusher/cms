<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 01.03.2015
 * Time: 17:08
 */

namespace app\modules\cart\controllers;


use app\models\CheckoutForm;
use app\models\Customers;
use app\models\Orders;
use yii\web\Controller;

class CheckoutController extends Controller
{
    public function actionIndex()
    {
        $checkout = new CheckoutForm();
        if(\Yii::$app->user->id) {
            $customer = Customers::findOne(['user_id' => \Yii::$app->user->id]);
            $checkout->attributes = $customer->attributes;
            $checkout->zipcode = $customer->getPrimaryAddress()->zipcode;
            $checkout->formatted_address = $customer->getPrimaryAddress()->formatted;
        }

        if(\Yii::$app->request->isPost) {
            $checkout->attributes = \Yii::$app->request->post('CheckoutForm');

            if($checkout->validate()) {
                $order = $checkout->save();
                if( $order ) {
                    \Yii::$app->session->set('order_id', $order->id);
                    $this->redirect(['/cart/checkout/confirm/']);
                }
            }
        }

        return $this->render('index', [
            'model' => $checkout
        ]);
    }

    public function actionConfirm()
    {
        $order = Orders::findOne(['id' => \Yii::$app->session->get('order_id')]);
        if(! $order ) {
            $this->redirect(['/catalog/default/index']);
        }

        \Yii::$app->session->remove('order_id');
        \Yii::$app->cart->removeAll();

        return $this->render('confirm', [
            'order' => $order,
        ]);
    }
}