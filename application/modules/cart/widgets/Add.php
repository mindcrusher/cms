<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 01.03.2015
 * Time: 15:39
 */

namespace app\modules\cart\widgets;

use yii\base\Widget;

class Add extends Widget
{
    const CSS_MANAGE_CLASS = 'cart__widget-control-add btn btn-warning';
    const CSS_SELECT_CLASS = 'cart__widget-select';

    public $offer;

    public function run()
    {
        $offer = current($this->offer);

        return $this->render('add', [
            'offer' => $offer,
        ]);
    }
}