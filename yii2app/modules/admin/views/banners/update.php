<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Banners */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => Yii::t('app', 'Banner'),
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="banners-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
