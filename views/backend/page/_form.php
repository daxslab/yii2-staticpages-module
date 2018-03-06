<?php

use daxslab\staticpages\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model daxslab\staticpages\common\models\Page */
/* @var $form yii\widgets\ActiveForm */


$editorConfig = $this->context->module->editorConfig;

?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'disabled' => true]) ?>

            <?= $form->field($model, 'abstract')->textarea(['rows' => 3]) ?>

            <?php if(isset($editorConfig)): ?>
                <?= $form->field($model, 'body')->widget($editorConfig['class'], $editorConfig) ?>
            <?php else: ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 10]) ?>
            <?php endif; ?>

        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'parent_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('staticpages', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
