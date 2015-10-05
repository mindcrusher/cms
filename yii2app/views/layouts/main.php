<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use \app\modules\cart\widgets\Cart;
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
        <div class="container">
            <div class="col-sm-12">
            <?php
            $menu = Yii::$app->controller->menu[2]['links'] ;
            echo yii\widgets\Menu::widget($menu);
            ?>
            </div>
        </div>
        <div class="container">
            <div class="col-sm-4">
                <?php
                $menu = Yii::$app->controller->menu[4]['links'] ;
                echo yii\widgets\Menu::widget($menu);
                ?>
            </div>
            <div class="col-sm-8">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>

        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="col-sm-12">
            <?php
            $menu = Yii::$app->controller->menu[5]['links'] ;
            echo yii\widgets\Menu::widget($menu);
            ?>
            </div>
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
