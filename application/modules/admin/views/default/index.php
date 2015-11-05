<h1>Управление контентом</h1>
<div class="row">
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Banners'),['banners/index']);?></h3>
        Карусель на главной странице
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Catalog'),['catalog/index']);?></h3>
        Разделы и содержание каталога
    </div>

    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Products'),['products/index']);?></h3>
        Товары
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Pages'),['pages/index']);?></h3>
        Управление страницами сайта
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Menu'),['menu/index']);?></h3>
        Объединение ссылок в меню
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Links'),['links/index']);?></h3>
        Управление ссылками
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Files'),['files/index']);?></h3>
        Файлы на сайте
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Redirect Rules'),['redirect/index']);?></h3>
        Правила перенаправлений страниц
    </div>
    <div class="col-sm-4">
        <h3><?= \yii\bootstrap\Html::a(Yii::t('app', 'Contacts'),['contact/index']);?></h3>
        Управление контактными данными
    </div>
</div>