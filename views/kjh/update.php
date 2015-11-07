<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kjh */

$this->title = '更新期号: ' . ' ' . $model->qh;
$this->params['breadcrumbs'][] = ['label' => '开奖号码', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->qh, 'url' => ['view', 'id' => $model->qh]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="kjh-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
