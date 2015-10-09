
<?php
use yii\helpers\Html;
use app\assets\AppAsset;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div style="padding-top:60px" class="wrap">
    <noindex>
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
            <h2 class="text-center">Сайт находится в разработке</h2>
        </div>
        <div class="col-sm-5"></div>
    </noindex>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
