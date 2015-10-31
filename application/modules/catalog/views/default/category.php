<?php
use yii\widgets\ListView;
?>
<h1><?=$category->name?></h1>
<?php
echo ListView::widget([
    'dataProvider' => $products,
    'itemView' => '_product',
]);
?>