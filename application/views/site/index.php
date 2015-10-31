<?php
$banners = \app\models\Banners::findActive();
$items = [];
foreach( $banners as $banner) {
    $items[] = $banner->getContent();
}
echo yii\bootstrap\Carousel::widget([
    'items' => $items,
]);
?>
<?=$model->text?>