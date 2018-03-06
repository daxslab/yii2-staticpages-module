<?php

use daxslab\staticpages\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model daxslab\staticpages\common\models\Page */

$this->title = Yii::t('staticpages', 'Update Page: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('staticpages', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('staticpages', 'Update');
?>
<div class="page-update">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <div class="row">
        <div class="col-md-8">
            <?= Yii::$app->runAction('staticpages/page/index', ['parent_id' => $model->id]) ?>
        </div>
    </div>

</div>
