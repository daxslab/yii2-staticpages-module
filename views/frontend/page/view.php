<?php

use yii\helpers\Html;

?>

<article>
    <header>
        <h1><?= Html::encode($model->title) ?></h1>
    </header>

    <?= call_user_func($this->context->module->formatter, $model->body) ?>

    <?php if ($model->getPages()->exists()): ?>

        <h2><?= Yii::t('staticpages', 'Sub pages') ?></h2>
        <ul>
            <?php foreach ($model->pages as $page): ?>
                <li><?= Html::a($page->title, $page->url)?></li>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>

</article>
