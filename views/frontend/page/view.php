<?php
/**
 * Created by PhpStorm.
 * User: glpz
 * Date: 5/03/18
 * Time: 23:19
 */

use yii\helpers\Html;
use yii\helpers\Markdown;

?>

<article>
    <header>
        <h1><?= Html::encode($model->title)?></h1>
    </header>

    <?= Markdown::process($model->body) ?>

</article>
