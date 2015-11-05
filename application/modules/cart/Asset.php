<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 02.03.2015
 * Time: 21:10
 */

namespace app\modules\cart;

use yii\web\AssetBundle;
use yii\web\View;

class Asset extends AssetBundle
{
    public $sourcePath = '@app/modules/cart/assets';
    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $css = [
        'css/cart-widget.css',
    ];

    public $js = [
        'js/cart-widget.js',
    ];

    public function init()
    {
        parent::init();
        $this->publishOptions['forceCopy'] = YII_DEBUG;
    }


    public $depends = [
        'app\assets\BackboneAsset',
    ];
}