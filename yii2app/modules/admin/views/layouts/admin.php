<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\modules\admin\assets\AppAsset;
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
                    'brandUrl' => Url::to(''),
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Наполнение', 'items' => [
                            ['label' => Yii::t('app', 'Pages'), 'url' => ['pages/index']],
                            ['label' => Yii::t('app', 'Links'), 'url' => ['links/index']],
                            ['label' => Yii::t('app', 'Menu'), 'url' => ['menu/index']],
                            ['label' => Yii::t('app', 'Files'), 'url' => ['files/index']],
                            ['label' => Yii::t('app', 'Redirect Rules'), 'url' => ['redirect/index']],
                            ['label' => Yii::t('app', 'Contacts'), 'url' => ['contact/index']],
                        ]],
                        ['label' => 'Калькулятор', 'items' => [
                                ['label' => 'Базовый тариф', 'url' => ['mode/index']],
                                ['label' => 'Опции', 'url' => ['modifications/index']],
                                ['label' => 'Группы опций', 'url' => ['groups/index']],
                                ['label' => 'Тариф', 'url' => ['tax/index']],
                                ['label' => 'Настройки', 'url' => ['settings/index']],
                            ],
                        ],
                        Yii::$app->user->isGuest ?
                            '' :
                            ['label' => 'Выйти',
                                'url' => ['/logout'],
                                'linkOptions' => ['data-method' => 'post']],

                ]]);
                NavBar::end();
            }
        ?>

        <div class="container">
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => 'Главная',
                        'url' => Url::to('/cms/'),
                        'itemprop' => 'url',
                    ],
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
