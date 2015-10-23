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
        <div class="row">
            <?php
            echo Nav::widget([
                'items' => [
                    ['label' => 'Обратная связь', 'url' => ['/site/contact'], 'linkOptions' => [
                        'class' =>  'showModalButton hidden-xs',
                        'data-target' => '#pending-form',
                        'data-toggle' => 'modal',
                        'title' => 'Обратная связь',
                    ]],
                    ['label' => 'Онлайн заявка', 'url' => ['/site/pending'], 'linkOptions' => [
                        'class' =>  'showModalButton hidden-xs',
                        'data-target' => '#pending-form',
                        'data-toggle' => 'modal',
                        'title' => 'Заявка онлайн',
                    ]],
                    ['label' => 'Обратная связь', 'url' => ['/site/contact'], 'linkOptions' => [
                        'class' =>  'visible-xs'
                    ]],
                    ['label' => 'Онлайн заявка', 'url' => ['/site/pending'], 'linkOptions' => [
                        'class' =>  'visible-xs'
                    ]],
                    ['label' => 'Калькулятор', 'url' => ['/calc/default/index']],
                ],
                'options' => [
                    'class' => 'navbar-nav navbar-right hidden-xs'
                ],
            ]);
            ?>
        </div>
        <div class="row">
            <?php
            $hasMenu = !empty(Yii::$app->controller->menu);
            if($hasMenu) {
            ?>
            <div id="menu" class="col-sm-3">
                <div class="row">
                    <div class="header visible-xs">
                        <div class="col-xs-6">
                            <button type="button">Меню</button>
                        </div>
                        <div class="col-xs-6 text-right">
                            <a href="/">Taggerd Logo</a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="collapsible-area">
                    <?php
                        echo Menu::widget(Yii::$app->controller->menu[4]['links']);
                    ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="col-xs-12 col-sm-<?=$hasMenu ? 9 : 12?>"><?=$content?></div>
        </div>
        <div class="row footer">
            <div class="col-sm-4">
                <?php foreach(app\models\Contacts::findAllActive() as $contact) { ?>
                    <div><span class="<?=$contact->icon()?>" aria-hidden="true"></span> &nbsp;<?=$contact->formatted();?></div>
                <? } ?>
            </div>
            <div class="col-sm-4 hidden-xs">
                <?php
                if(!empty(Yii::$app->controller->menu)) {
                    echo Menu::widget(Yii::$app->controller->menu[5]['links']);
                }
                ?>
            </div>
            <div class="col-sm-4">somtehting else</div>
        </div>
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
