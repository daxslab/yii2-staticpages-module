<?php

use yii\helpers\Html;
use daxslab\staticpages\components\Utils;

/* @var $this yii\web\View */
/* @var $model daxslab\staticpages\models\Page */

$this->title = Yii::t('staticpages', 'Update Page: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);

$this->params['breadcrumbs'] = Utils::breadcrumbsForPage($model);

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
