<?php

use daxslab\staticpages\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model daxslab\staticpages\common\models\Page */

$this->title = Yii::t('staticpages', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('staticpages', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
