<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcModifications */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'опцию',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calc-modifications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
