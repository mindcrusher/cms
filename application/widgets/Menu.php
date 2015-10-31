<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 27.10.2015
 * Time: 22:54
 */

namespace app\widgets;

use kgladkiy\widgets\NestedList;
use yii\bootstrap\Html;

class Menu extends NestedList
{
    public $actions = false;
    public $wrapClass = 'catalog-menu';

    public function registerAssets()
    {
        return false;
    }

    protected function buildListItem($item)
    {
        $html = '';
        $html .= Html::tag('a', $item['name'], ['href'=> $item['url']]);

        if (count($item['children'])>0) {
            $html .= $this->buildList($item['children']);
        }
        return $html;
    }
}