<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CalcTax */

$this->title = Yii::t('app', 'Update {modelClass}', [
    'modelClass' => 'базовый тариф',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Taxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calc-tax-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
