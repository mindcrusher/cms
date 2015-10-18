<?php
// VIEW - views/product/index.php
use kartik\tree\TreeView;
use app\models\Category;

echo TreeView::widget([
    'query' => Category::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => 'Categories'],
    'rootOptions' => ['label'=>'<span class="text-primary">Root</span>'],
    'fontAwesome' => false,
    'isAdmin' => true,
    'displayValue' => 1,
    'softDelete' => true,
    'showIDAttribute' => false,
    'alertFadeDuration' => 1000,
    'nodeView' => '@app/modules/admin/views/catalog/_form',
    'cacheSettings' => [
        'enableCache' => false
    ]
]);;