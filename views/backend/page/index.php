<?php

use daxslab\staticpages\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel daxslab\staticpages\backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('staticpages', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'language',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Html::encode($model->title), ['update', 'id' => $model->id], ['data-pjax' => 0]);
                }
            ],
            'slug',
            //'image',
            //'keywords',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Html::a(Yii::t('staticpages', 'Create Page'),
                    ['create', 'parent_id' => isset($parent_id) ? $parent_id : null], ['class' => 'btn btn-success']),
                'template' => '{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
