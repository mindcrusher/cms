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
                $url = $model->getUrl();
                return Html::a($url, $url, ['target' => 'new']);
            }, 'format' => 'raw'],
            ['attribute' => 'page_id', 'value' => function($model){
                $title = !empty($model->page->title) ? $model->page->title : null;

                return $title;
            }],
            [
                'attribute' => 'is_active',
                'value' => function($model) {
                    return \app\components\Helper::boolLabel($model);
                }
            ],
            // 'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
