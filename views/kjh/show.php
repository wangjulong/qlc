<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kjh */

$this->title = '查询开奖号码';
$this->params['breadcrumbs'][] = ['label' => '开奖号码', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kjh-create">
    <div class="row">
        <table class="table table-bordered text-center table-hover table-condensed">
            <thead>
            <tr>
                <th style="text-align:center">期号</th>
                <th style="text-align:center">00</th>
                <th style="text-align:center">01</th>
                <th style="text-align:center">03</th>
                <th style="text-align:center">04</th>
                <th style="text-align:center">05</th>
                <th style="text-align:center">06</th>
                <th style="text-align:center">07</th>
                <th style="text-align:center">08</th>
                <th style="text-align:center">09</th>
                <th style="text-align:center">10</th>
                <th style="text-align:center">11</th>
                <th style="text-align:center">12</th>
                <th style="text-align:center">13</th>
                <th style="text-align:center">14</th>
                <th style="text-align:center">15</th>
                <th style="text-align:center">16</th>
                <th style="text-align:center">17</th>
                <th style="text-align:center">18</th>
                <th style="text-align:center">19</th>
                <th style="text-align:center">20</th>
                <th style="text-align:center">21</th>
                <th style="text-align:center">22</th>
                <th style="text-align:center">23</th>
                <th style="text-align:center">24</th>
                <th style="text-align:center">25</th>
                <th style="text-align:center">26</th>
                <th style="text-align:center">27</th>
                <th style="text-align:center">28</th>
                <th style="text-align:center">29</th>
                <th style="text-align:center">30</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model as $arr): ?>
                <?= $arr; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!--/.row-->


</div>
