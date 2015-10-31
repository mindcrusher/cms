<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \yii\data\ArrayDataProvider;
use \yii\grid\GridView;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$active_class = $model->isNewRecord ? 'active' : '';
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"class="<?=!$model->isNewRecord ? 'active' : ''?>"><a href="#relations" aria-controls="relations" role="tab" data-toggle="tab">Состав меню</a></li>
    <li role="presentation" class="<?=$model->isNewRecord ? 'active' : ''?>"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Основное</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane <?=$model->isNewRecord ? 'active' : ''?>" id="basic">
        <div class="menu-form">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'is_active')->checkbox() ?>

            <?= $form->field($model, 'display_name')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
    <div role="tabpanel" class="tab-pane <?=!$model->isNewRecord ? 'active' : ''?>" id="relations">
        <?php if(!$model->isNewRecord){ ?>
            <div class="related-data">
                <?php
                $relModel = new \app\models\MenuRelations();
                ?>
                <div class="menu-relations-form">

                    <?php $form = ActiveForm::begin(['action' => ['mrelations/create']]); ?>

                    <?= Html::activeHiddenInput($relModel, 'menu_id', ['value' => $model->id]) ?>
                    <?= $form->field($relModel, 'link_id')->widget(\yii\jui\AutoComplete::classname(), [
                        'clientOptions' => [
                            'source' => $model->getFreeLinks(),
                        ],
                        'options' => [
                            'class' => 'form-control',
                            'placeholder' => 'Начните вводить заголовок страницы'
                        ]
                    ]) ?>
                    <?= Html::submitButton($relModel->isNewRecord ? Yii::t('app', 'Add') : Yii::t('app', 'Update'), ['class' => $relModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    <?php ActiveForm::end(); ?>

                </div>
                <?php

                $dataProvider = new ArrayDataProvider([
                    'key'=>'id',
                    'allModels' => $model->links,
                    'sort' => [
                        'attributes' => ['id', 'name', 'sort'],
                    ],
                ]);

                echo GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => [
                        'id',
                        [
                            'attribute' => 'name',
                            'value' => function( $model ) {
                                return $model->link->name;
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'urlCreator'=>function($action, $model, $key, $index){
                                return Url::to(['mrelations/delete/','id'=>$model->id, 'menu_id' => $model->menu_id]);

                            },
                            'template'=>'{delete}',
                        ],
                    ]
                ]);
                ?>
            </div>
        <?php } else {?>
            Пожалуйста, вначале сохраните меню
        <?php } ?>
    </div>
</div>

