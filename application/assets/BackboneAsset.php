<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 02.03.2015
 * Time: 22:45
 */

namespace app\assets;


use spacedealer\backbone\Asset;

class BackboneAsset extends Asset
{
    public $jsOptions = ['position' => \yii\web\View::POS_END];
}