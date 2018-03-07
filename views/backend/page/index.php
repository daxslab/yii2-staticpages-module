<?php

use daxslab\staticpages\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel daxslab\staticpages\backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$tag = 'h2';
$title = Yii::t('app', 'Sub pages');

$module = $this->context->module;
$availableLanguages = array_combine($module->languages, $module->languages);

if (!isset($parent_id)) {
    $this->title = Yii::t('staticpages', 'Pages');
    $this->params['breadcrumbs'][] = $this->title;

    $tag = 'h1';
    $title = $this->title;
}

?>
<div class="page-index">

    <header class="page-header">
        <?= Html::tag($tag, Html::encode($title)) ?>
    </header>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => [
                    'width' => '40px',
                ]
            ],
            [
                'attribute' => 'language',
                'filter' => $availableLanguages,
                'options' => [
                    'width' => '10%',
                ],
                'visible' => !isset($parent_id),
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->title), ['update', 'id' => $model->id], ['data-pjax' => 0]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Html::a(Html::tag('i', null, ['class' => 'fa fa-plus']),
                    ['create', 'parent_id' => isset($parent_id) ? $parent_id : null], [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('staticpages', 'Create Page')
                    ]),
                'template' => '{delete}',
                'options' => [
                    'width' => '20px',
                ],
                'contentOptions' => [
                    'style' => Html::cssStyleFromArray([
                        'text-align' => 'center',
                    ]),
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
