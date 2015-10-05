<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Links');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="links-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Links'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            ['attribute' => 'alias', 'value' => function($model){
                $url = \yii\helpers\Url::to(['/site/info', 'alias' => $model->alias]);
                return Html::a($url, $url, ['target' => 'new']);
            }, 'format' => 'raw'],
            ['attribute' => 'page_id', 'value' => function($model){ return $model->page->title;}],
            // 'is_active',
            // 'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>