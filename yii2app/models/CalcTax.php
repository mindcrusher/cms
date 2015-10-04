<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calc_tax".
 *
 * @property integer $id
 * @property double $tax_value
 * @property string $measure
 */
class CalcTax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['tax_value'], 'number'],
            [['measure'], 'string', 'max' => 63]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax_value' => 'Тариф',
            'measure' => 'Единицы измерения',
        ];
    }
}
