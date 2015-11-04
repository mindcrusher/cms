<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\components\Helper;
use app\models\Files;
use app\models\Products;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ImportController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    public function actionPhotos()
    {
        $root = \Yii::$app->params['webroot'] . '/files/storage/images';
        $command = "find $root *.*";
        $files = explode(PHP_EOL, shell_exec($command));
        foreach($files as $path) {
            $file = new Files();
            $file->importFile($path);
        }
    }

    public function actionForeignFiles()
    {
        $root = \Yii::$app->params['webroot'];
        $files = Files::find()
            ->where('origin like "%http%"')
            ->all();

        foreach ($files as $file) {
            $src = $file->origin;
            $tmp = \Yii::getAlias('@runtime') . '/tmpFile'. uniqid();
            \Yii::info("Get $src");
            if(copy($src, $tmp)) {
                $file->hash = Files::hash($tmp);
                $file->ext = Files::getExtension( $src );
                $destination = $file->getPath();
                \Yii::info("try to save to $destination");
                if(rename( $tmp, $root . $destination )) {
                    $file->src = $destination;
                    if($file->save()) {
                        \Yii::info("Done");
                    } else
                        \Yii::error("Fail to save");
                } else {
                    \Yii::error("Fail to move to $destination");
                }
            } else {
                \Yii::error("Fail to copy to $root$tmp");
            }
        }
    }

    public function actionUpdateProductSlug()
    {
        foreach (Products::find()->all() as $product) {
            var_dump($product->save());
        }

    }
}
