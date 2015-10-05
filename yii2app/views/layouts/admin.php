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
        <?php
            if(!Yii::$app->user->isGuest) {
                NavBar::begin([
                    'brandLabel' => 'Администрирование сайта',
                    'brandUrl' => Url::to('/cms/'),
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Наполнение', 'items' => [
                            ['label' => 'Страницы', 'url' => ['/admin/pages/index']],
                            ['label' => 'SEO', 'url' => ['/admin/seo/index']],
                            ['label' => 'Ссылки', 'url' => ['/admin/links/index']],
                            ['label' => 'Меню', 'url' => ['/admin/menu/index']],
                            ['label' => 'Перенаправление страниц', 'url' => ['/admin/redirect/index']],
                        ]],
                        ['label' => 'Калькулятор', 'items' => [
                                ['label' => 'Базовый тариф', 'url' => ['/admin/mode/index']],
                                ['label' => 'Опции', 'url' => ['/admin/modifications/index']],
                                ['label' => 'Группы опций', 'url' => ['/admin/groups/index']],
                                ['label' => 'Тариф', 'url' => ['/admin/tax/index']],
                                ['label' => 'Настройки', 'url' => ['/admin/settings/index']],
                            ],
                        ],

                ]]);
                NavBar::end();
            }
        ?>

        <div class="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        </div>
    </footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
