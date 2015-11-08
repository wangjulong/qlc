<?php

namespace app\controllers;

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
        $model = new Kjh();
        $result = $model->getKjhBD();
        Kjh::deleteAll();

        foreach ($result as $rows) {
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

        // 成功自动跳转到走势图页面
        $this->redirect('/kjh/show');
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
            throw new Exception('需要显示的期数不能大于数据库里存在的数据的期数，只能是数字');
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
