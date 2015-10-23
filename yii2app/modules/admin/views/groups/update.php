<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcModificationsGroups */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Calc Modifications Groups',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modifications Groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calc-modifications-groups-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
