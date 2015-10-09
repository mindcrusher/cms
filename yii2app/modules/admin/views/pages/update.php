<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pages */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pages',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pages-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Текст
            </a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">SEO</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="profile">...</div>
    </div>

</div>
</div>
<div>