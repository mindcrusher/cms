<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\calculator\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/calculator/assets/files';

    public $css = [
        'css/style.css'
    ];

    public $js = [
        'js/app.js',
        'http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public $publishOptions = [
        'forceCopy'=>true,
    ];

}
