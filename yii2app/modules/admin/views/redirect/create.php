<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RedirectRules */

$this->title = Yii::t('app', 'Create Redirect Rules');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Redirect Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-rules-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
