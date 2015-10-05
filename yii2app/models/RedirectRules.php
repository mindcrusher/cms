<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redirect_rules".
 *
 * @property integer $id
 * @property string $from
 * @property string $to
 * @property string $status_code
 */
class RedirectRules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'redirect_rules';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_code'], 'string'],
            [['from', 'to'], 'string', 'max' => 255],
            [['from'], 'unique'],
            [['from','to'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'Откуда',
            'to' => 'Куда',
            'status_code' => 'Код заголовка',
        ];
    }
}
