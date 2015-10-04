<?php

namespace app\models;

use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "calc_mode".
 *
 * @property integer $id
 * @property string $mode
 * @property integer $hours
 * @property integer $mode_factor
 * @property integer $avg_hours
 */
class CalcMode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc_mode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hours', 'mode_factor', 'avg_hours', 'name'], 'required'],
            [['hours', 'mode_factor', 'avg_hours'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'hours' => 'Часов в смену',
            'mode_factor' => 'Фактор влияния на цену, %',
            'avg_hours' => 'Ср. кол-во часов в год',
            'is_active' => 'Активен',
        ];
    }
    
    /**
    * Возвращает цену на режим работы
    */
    public function getPrice($mods = null)
    {
        $tax = CalcTax::findOne(['id' => 1])->tax_value;
        $base_price = $this->avg_hours * $tax;

        $additionalPercent = $this->mode_factor;

        if($mods) {
            if(is_string($mods)) {
                $mods = [$mods];
            }

            if(!is_array($mods)) {
                throw new Exception('Wrong type of `mods` data');
            }

            $modifications = CalcModifications::findAll($mods);
            foreach ($modifications as $mod) {
                $additionalPercent += $mod->mode_factor;
            }
        }

        $base_price = $base_price + ($base_price / 100 * $additionalPercent);

        return $base_price;
    }
}
