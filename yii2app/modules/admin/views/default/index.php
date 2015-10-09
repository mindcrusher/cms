<h1>Управление контентом</h1>
<div class="row">
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Pages') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['pages/index']);?>
    </div>

    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'SEO') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['seo/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Menu') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['menu/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Links') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['pages/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Redirect Rules') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['seo/index']);?>
    </div>
</div>

<h1>Настройки калькулятора</h1>
<div class="row">
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Настройка тарифа') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['mode/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Список опций') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['modifications/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Группы опций') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['groups/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Тариф') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['tax/index']);?>
    </div>
    <div class="col-sm-4">
        <h3><?= Yii::t('app', 'Установки') ?></h3>
        <?= \yii\bootstrap\Html::a('Перейти в раздел',['settings/index']);?>
    </div>
</div>