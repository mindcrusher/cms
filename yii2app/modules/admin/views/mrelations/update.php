<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MenuRelations */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Menu Relations',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-relations-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
