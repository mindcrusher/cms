<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.10.2015
 * Time: 22:13
 */

namespace app\controllers;

use app\models\MenuGroups;

class Controller extends \yii\web\Controller
{
    public $menu;

    public function init()
    {
        $groups = MenuGroups::findAll(['is_active' => 1]);
        foreach ($groups as $group) {
            $items = [];
            foreach($group->menu as $link) {
                $items[] = ['label' => $link->name, 'url' => ['site/info', 'alias' => $link->page->alias]];
            }

            $this->menu[$group->id] = [
                'name' => $group->display_name ? $group->name : '',
                'links' => ['items' => $items],
            ];
        }
    }
}