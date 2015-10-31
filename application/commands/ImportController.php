<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Files;
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
            ->where('src like "%http%"')
            ->all();

        foreach ($files as $file) {
            $src = $file->origin;
            $tmp = \Yii::getAlias('@runtime') . '/tmpFile'. uniqid();

            if(copy($src, $tmp)) {
                $file->hash = Files::hash($tmp);
                $file->ext = Files::getExtension( $src );
                $destination = $file->getPath();
                if(rename( $tmp, $root . $destination )) {
                    $file->src = $destination;
                    var_dump($file->save());
                }
            }
        }
    }
}
