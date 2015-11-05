<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 01.03.2015
 * Time: 15:39
 */

namespace app\modules\cart\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class FastAdd extends Widget
{
    public $product;

    public function run()
    {
        $offers = $this->product->offers;
        $hasSeveralOffers = count($offers) > 1;
        $offer = current($offers);
        $action = $hasSeveralOffers ? 'cart__widget-control-dialog' : 'cart__widget-control-add';
        $url = $hasSeveralOffers ?
            $this->product->getUrl() :
            [
                '/cart/default/do',
                'offer_id' => $offer->id,
                'quantity' => 1,
                'action' => 'add',
            ];

        return Html::a('Добавить в корзину', $url,
            [
                'class' => $action.' btn btn-primary',
                'data-offer_id' => $offer->id,
                'data-id' => $this->product->id,
                'data-toggle' => 'modal',
                'data-target' => '#modalAlert',
            ]
        );
    }
}