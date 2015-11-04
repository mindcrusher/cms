<?php
// VIEW - views/product/index.php
use kartik\tree\TreeView;
use app\models\Tree;
$this->title = 'Catalog';
$this->params['breadcrumbs'][] = Yii::t('app',$this->title );

echo TreeView::widget([
    'query' => Tree::find()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => Yii::t('app', 'Categories')],
    'rootOptions' => ['label'=>'<span class="text-primary">Root</span>'],
    'fontAwesome' => false,
    'isAdmin' => true,
    'displayValue' => 1,
    'softDelete' => false,
    'showIDAttribute' => false,
    'alertFadeDuration' => 1000,
    'nodeView' => '@app/modules/admin/views/catalog/_form',
    'cacheSettings' => [
        'enableCache' => false
    ]
]);;