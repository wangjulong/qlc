<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KjhSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kjh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'qh') ?>

    <?= $form->field($model, 'n1') ?>

    <?= $form->field($model, 'n2') ?>

    <?= $form->field($model, 'n3') ?>

    <?= $form->field($model, 'n4') ?>

    <?= $form->field($model, 'n5') ?>

    <?= $form->field($model, 'n6') ?>

    <?= $form->field($model, 'n7') ?>

    <?= $form->field($model, 'n8') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
