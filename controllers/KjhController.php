<?php

namespace app\controllers;

use Snoopy\Snoopy;
use Yii;
use app\models\Kjh;
use app\models\KjhSearch;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KjhController implements the CRUD actions for Kjh model.
 */
class KjhController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Kjh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KjhSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kjh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kjh model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kjh();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->qh]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Kjh model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->qh]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kjh model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kjh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kjh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kjh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 开奖号码整体更新
     */
    public function actionUpdates()
    {
        /* 通过百度彩票网得到开奖数据(二维数组)
        2015101 =>
            array(size = 9)
                0 => string '2015101' (length = 7)
                1 => string '07' (length = 2)
                2 => string '12' (length = 2)
                3 => string '16' (length = 2)
                4 => string '18' (length = 2)
                5 => string '22' (length = 2)
                6 => string '23' (length = 2)
                7 => string '29' (length = 2)
                8 => string '06' (length = 2)
        */
        $model = $this->getKjhBD();
        Kjh::deleteAll();

        foreach ($model as $rows) {
            $model = new Kjh();
            $model->qh = $rows[0];
            $model->n1 = $rows[1];
            $model->n2 = $rows[2];
            $model->n3 = $rows[3];
            $model->n4 = $rows[4];
            $model->n5 = $rows[5];
            $model->n6 = $rows[6];
            $model->n7 = $rows[7];
            $model->n8 = $rows[8];
            $model->save();
        }
    }


    /**
     * @return array 开奖号码二维数组
     * 通过百度彩票网得到开奖数据(二维数组)
     * 2015101 =>
     * array(size = 9)
     * 0 => string '2015101' (length = 7)
     * 1 => string '07' (length = 2)
     * 2 => string '12' (length = 2)
     * 3 => string '16' (length = 2)
     * 4 => string '18' (length = 2)
     * 5 => string '22' (length = 2)
     * 6 => string '23' (length = 2)
     * 7 => string '29' (length = 2)
     * 8 => string '06' (length = 2)
     */
    protected function getKjhBD()
    {
        // 保存结果的二维数组
        $numbers = array();
        $snoopy = new Snoopy();

        // 得到网页内容
        $strBD = "http://trend.baidu.lecai.com/qlc/baseTrend.action?recentPhase=30&onlyBody=true";
        $snoopy->fetch($strBD);

        // 取出网页内容到变量中
        $result = $snoopy->results;

        // 把结果转换成数组
        $separator = '<td class="chart_table_td">';
        $arr = explode($separator, $result);

        // 遍历数组，并截取需要的部分
        foreach ($arr as $value) {

            // 截取字符串功能
            $pattern = '/^\d{7}/';

            if (preg_match($pattern, $value)) {

                // 临时数组
                $temps = array();
                // 期号位于数组的开始部分
                $temps['qh'] = substr($value, 0, 7);

                // 根据特别号码的css类名查找特别号码的位置
                $special = "qlc_te";
                $len = strrpos($value, $special);
                $temps['n8'] = substr($value, $len + 8, 2);

                // 把字符串分割按照行成数组
                $row = explode('</td>', $value);

                // 循环数组查找七个号码
                foreach ($row as $td) {
                    if ($reds = strrpos($td, 'red_ball')) {
                        $temps[] = substr($td, $reds + 10, 2);
                    }
                }
                $numbers[$temps['qh']] = array(
                    $temps['qh'],
                    $temps[0],
                    $temps[1],
                    $temps[2],
                    $temps[3],
                    $temps[4],
                    $temps[5],
                    $temps[6],
                    $temps['n8']
                );
            }
        }
        //返回结果数组
        return $numbers;
    }

    /**
     * 展示开奖号码表格
     */
    public function actionShow()
    {

        // 是否包含需要显示的期数,没有在赋值为15
        $num = Yii::$app->request->get('num');
        if ($num == null) {
            $num = 15;
        }

        // 保证需要显示的期数不大于数据库里存在的数据的期数
        if ($num > Kjh::find()->count()) {
            throw new Exception('需要显示的期数不能大于数据库里存在的数据的期数');
        }

        // 从数据库中取出数据 $num
        $temp = Kjh::find()->limit($num)->orderBy('qh DESC')->all();
        $temp2 = array_reverse($temp);

        $model = $this->numbersFormat($temp2);

        return $this->render('show', ['model' => $model]);
    }

    protected function numbersFormat($numbers)
    {
        $views = array();

        // Step 2 循环数组，组合字符串
        foreach ($numbers as $number) {

            // 字符串头部
            $temp = '<tr>' . '<td>' . $number['qh'] . '</td>';

            // 30个单元格
            $n = array();
            for ($i = 1; $i <= 31; $i++) {
                $n[$i] = '<td></td>';
            }

            // 添加开奖号码到数组中
            $n[$number['n1']] = '<td><span>' . $number['n1'] . '</span></td>';
            $n[$number['n2']] = '<td><span>' . $number['n2'] . '</span></td>';
            $n[$number['n3']] = '<td><span>' . $number['n3'] . '</span></td>';
            $n[$number['n4']] = '<td><span>' . $number['n4'] . '</span></td>';
            $n[$number['n5']] = '<td><span>' . $number['n5'] . '</span></td>';
            $n[$number['n6']] = '<td><span>' . $number['n6'] . '</span></td>';
            $n[$number['n7']] = '<td><span>' . $number['n7'] . '</span></td>';
            $n[31] = '<td><span>' . $number['n8'] . '</span></td>';

            // 组合字符串
            for ($i = 1; $i <= 31; $i++) {
                $temp .= $n[$i];
            }
            $temp .= '</tr>';

            // 加入数组
            $views[$number['qh']] = $temp;
        }

        // 返回数组
        return $views;
    }
}
