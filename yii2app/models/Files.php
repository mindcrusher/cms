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
    public $file;
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
            [['name'], 'safe'],
            [['src'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, doc, xls'],
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
            'name' => 'Название',
            'file' => 'Файл',
            'size' => 'Размер',
        ];
    }

    public function getPath()
    {
        $root = Yii::getAlias('@webroot');
        preg_match('#^(\S{3})(.+)$#',$this->hash, $s);
        $directory = Yii::$app->params['storageDirectory'] . $s[1] . DIRECTORY_SEPARATOR;
        $src =  $directory . $s[2] . '.' .  $this->ext;

        if(!is_dir($root . $directory)) {
            mkdir( $root . $directory, 0777, true );
        }

        return $src;
    }

    public function getUrl()
    {
        return $this->src;
    }

    public function importFile( $path , $name = null, $allowMove = false)
    {
        if(is_file($path)) {
            $i = pathinfo($path);
            $root = Yii::$app->params['webroot'];
            $hash = md5_file($path);

            $this->origin = $path;
            $this->name = trim( empty($name) ? $i['basename'] : $name );
            $this->ext = strtolower( $i['extension'] );
            $this->hash = $hash;
            $this->size = filesize($path);
            if($allowMove) {
                $this->src = $this->getPath();
                rename( $path , $root . $this->src );
            } else {
                $this->src = $path;
            }
            $this->src = substr($this->src, strlen($root));
            $this->origin = substr($this->origin, strlen($root));

            return $this->save();
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            if(!empty($this->file)) {
                $this->ext = $this->file->extension;
                $this->hash = md5_file($this->file->tempName);
                $this->size = $this->file->size;
                $this->name = empty($this->name) ? $this->file->baseName : $this->name;
                $this->src = $this->getPath();
            }

            $this->save();
            if(!empty($this->file)) {
                $this->file->saveAs(Yii::getAlias('@webroot') . $this->getPath());
            }
            return true;
        } else {
            return false;
        }
    }
}
