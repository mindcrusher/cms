<?php
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
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
    <div class="container">
        <div class="hidden-sm">
            <?php
            echo raoul2000\widget\slideout\Slideout::widget([
                'pluginOptions' => [
                    'panel' =>  new yii\web\JsExpression("document.getElementById('panel')"),
                    'menu' => new yii\web\JsExpression("document.getElementById('menu')"),
                    'padding' => 256,
                    'tolerance' => 70
                ]
            ]);

            ?>
            <nav id="menu">
                <header>
                    <span class="h2">Главное меню</span>
                </header>
                <?php
                echo Menu::widget(Yii::$app->controller->menu[4]['links']);
                ?>
            </nav>
        </div>
        <main id="panel">
            <div class="row">
                <?php
                NavBar::begin(['brandLabel' => 'Taggerd', 'id' => 'navbar-main']);
                echo Nav::widget([
                    'items' => [
                        ['label' => 'Домой', 'url' => ['/site/index']],
                        ['label' => 'Онлайн заявка', 'url' => ['/site/pending'], 'linkOptions' => [
                            'class' =>  'showModalButton hidden-xs',
                            'data-target' => '#pending-form',
                            'data-toggle' => 'modal',
                            'title' => 'Заявка онлайн',
                        ]],
                        ['label' => 'Онлайн заявка', 'url' => ['/site/pending'], 'linkOptions' => [
                            'class' =>  'visible-xs'
                        ]],
                        ['label' => 'Калькулятор', 'url' => ['/calc/default/index']],
                    ],
                    'options' => [
                        'class' => 'navbar-nav navbar-right'
                    ],
                ]);
                NavBar::end();
                ?>
            </div>
            <div class="row">
                <div class="col-sm-3 hidden-xs">
                    <?php
                    echo Menu::widget(Yii::$app->controller->menu[4]['links']);
                    ?>
                </div>
                <div class="col-xs-12 col-sm-9"><?=$content?></div>
            </div>
            <footer>
                <div>
                    <div class="row">
                        <div class="col-sm-4">contacts</div>
                        <div class="col-sm-4">
                            <?php
                            echo Menu::widget(Yii::$app->controller->menu[5]['links']);
                            ?>
                        </div>
                        <div class="col-sm-4">somtehting else</div>
                    </div>
                </div>
            </footer>
        </main>
    </div>



<?php $this->endBody() ?>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'pending-form',
    //'size' => 'modal-md',
    //'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
]);
echo "<div id='modalContent'>Подождите...</div>";
yii\bootstrap\Modal::end();
?>


</body>
</html>
<?php $this->endPage() ?>
