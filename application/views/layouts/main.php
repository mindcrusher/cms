<?php
use yii\helpers\Html;
use \app\widgets\Menu;
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
    <?php
    echo \app\modules\cart\widgets\Cart::widget()
    ?>
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
                        'class' =>  'showModalButton',
                        'data-target' => '#pending-form',
                        'data-toggle' => 'modal',
                        'title' => 'Обратная связь',
                    ]],
                ],
                'options' => [
                    'class' => 'navbar-nav navbar-right'
                ],
            ]);
            ?>
        </div>
        <div class="row">
            <nav class="col-sm-3">
            <?php
            echo Menu::widget();
            ?>
            </nav>
            <div class="col-sm-9">
                <main>
                    <?=$content?>
                </main>
            </div>
        </div>
        <div class="row">
            <footer class="text-center">
                <?=Yii::$app->name?>
            </footer>
        </div>
    </div>
<?php $this->endBody() ?>
<script type="text/template" id="dialog-offers">
    <form>
        <div class="form-group">
            <label>Выберите:</label>
            <% _.each(offers, function( offer ){%>
                <a href="#"
                   class="<?= \app\modules\cart\widgets\Add::CSS_SELECT_CLASS ?> <?= \app\modules\cart\widgets\Add::CSS_MANAGE_CLASS ?>"
                   data-offer_id="<%= offer.id %>"
                    ><%= offer.title %></a>
            <% });%>
        </div>

    </form>
</script>
<?php
yii\bootstrap\Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'pending-form',
]);
echo "<div id='modalContent'>Подождите...</div>";
yii\bootstrap\Modal::end();
?>


</body>
</html>
<?php $this->endPage() ?>
