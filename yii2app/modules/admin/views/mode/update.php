<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcMode */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Calc Mode',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calc-mode-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
