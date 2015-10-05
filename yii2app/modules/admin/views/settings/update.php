<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcSettings */

$this->title = Yii::t('app', 'Update {modelClass}', [
    'modelClass' => 'настройки',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calc-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
