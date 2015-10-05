<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CalcMode */

$this->title = Yii::t('app', 'Create Calc Mode');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calc Modes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calc-mode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
