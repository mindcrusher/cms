<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property string $src
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hash'], 'unique'],
            [['src'], 'unique'],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Расположение',
        ];
    }

    public function getPath()
    {
        return Yii::$app->params['storageDirectory'] . $this->src;
    }

    public function getUrl()
    {
        return $this->src;
    }

    public function importFile( $path , $name = null, $allowMove = false)
    {
        if(is_file($path)) {
            $i = pathinfo($path);
            $root = Yii::$app->params['storageDirectory'];
            $hash = md5_file($path);

            $this->origin = $path;
            $this->name = trim( empty($name) ? $i['basename'] : $name );
            $this->ext = strtolower( $i['extension'] );
            $this->hash = $hash;
            $this->size = filesize($path);
            if($allowMove) {
                preg_match('#^(\S{4})(.+)$#',$hash, $s);
                $directory = DIRECTORY_SEPARATOR . $s[1] . DIRECTORY_SEPARATOR;
                $this->src   =  $directory . $s[2] . '.' .  $this->ext;
                if(!is_dir($root . $directory)) {
                    mkdir( $root . $directory );
                }
                rename( $path , $root . $this->src );
            } else {
                $this->src = $path;
            }
            $this->src = substr($this->src, strlen($root));
            $this->origin = substr($this->origin, strlen($root));

            return $this->save();
        }
    }
}
