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
        $i = pathinfo($this->src);
        $root = Yii::$app->params['webroot'];
        preg_match('#^(\S{3})(.+)$#',$this->hash, $s);
        $this->ext = empty($this->ext) ? $i['extension'] : $this->ext;
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
            $hash = self::hash($path);

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
        $hash = self::hash($this->file->tempName);
        $exists = self::findOne(['hash' => $hash]);
        if (empty($exists)) {
            if (!empty($this->file)) {
                $this->ext = $this->file->extension;
                $this->hash = $hash;
                $this->size = $this->file->size;
                $this->name = empty($this->name) ? $this->file->baseName : $this->name;
                $this->src = $this->getPath();
            }

            $this->save();
            if (!empty($this->file)) {
                $this->file->saveAs(Yii::getAlias('@webroot') . $this->getPath());
            }
            return $this->id;
        } else {
            return $exists->id;
        }
    }

    public function afterDelete()
    {
        unlink(Yii::getAlias('@webroot') . $this->getPath());
    }

    /**
     * Возвращает хеш файла
     * @param $target
     * @return string
     */
    public static function hash( $target )
    {
        return md5_file( $target );
    }

    /**
     * Возвращает расширение файла
     * @param $target
     * @return mixed
     */
    public static function getExtension( $target )
    {
        $i = pathinfo($target);
        return $i['extension'];
    }
}
