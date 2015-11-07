<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kjh */

$this->title = '添加开奖号码';
$this->params['breadcrumbs'][] = ['label' => '开奖号码', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kjh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
