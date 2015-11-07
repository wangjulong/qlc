<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kjh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kjh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'qh')->textInput() ?>

    <?= $form->field($model, 'n1')->textInput() ?>

    <?= $form->field($model, 'n2')->textInput() ?>

    <?= $form->field($model, 'n3')->textInput() ?>

    <?= $form->field($model, 'n4')->textInput() ?>

    <?= $form->field($model, 'n5')->textInput() ?>

    <?= $form->field($model, 'n6')->textInput() ?>

    <?= $form->field($model, 'n7')->textInput() ?>

    <?= $form->field($model, 'n8')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
