<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MenuRelations */

$this->title = Yii::t('app', 'Create Menu Relations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menu Relations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-relations-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
