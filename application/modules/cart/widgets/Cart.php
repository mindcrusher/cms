<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 02.03.2015
 * Time: 21:02
 */

namespace app\modules\cart\widgets;


use yii\base\Widget;

class Cart extends Widget
{
	public $visible = true;
	
    public function run()
    {
        return $this->render('cart',[
            'cart' => \Yii::$app->cart,
			'visible' => $this->visible,
        ]);
    }
}