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
class CalcSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['base_tax_text', 'show_options_text', 'show_options_text'], 'string', 'max' => 45],
            [['calc_header'], 'string', 'max' => 63],
            [['cost_header'], 'string', 'max' => 63],
            [['calc_note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'base_tax_text' => 'Заголовок базового тарифа',
            'show_options_text' => 'Заголовок показа опций',
            'hide_options_text' => 'Заголовок сокрытия опций',
            'calc_header' => 'Заголовок страницы',
            'cost_header' => 'Заголовок расчитанной цены',
            'calc_note' => 'Примечание к рассчёту',
        ];
    }
}
