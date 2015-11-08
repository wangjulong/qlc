<?php

namespace app\models;

use Snoopy\Snoopy;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "kjh".
 *
 * @property integer $qh
 * @property integer $n1
 * @property integer $n2
 * @property integer $n3
 * @property integer $n4
 * @property integer $n5
 * @property integer $n6
 * @property integer $n7
 * @property integer $n8
 */
class Kjh extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kjh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['qh', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8'], 'required'],
            [['qh', 'n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8'], 'integer'],
            [['n1', 'n2', 'n3', 'n4', 'n5', 'n6', 'n7', 'n8'], 'in','range'=>[
                1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30
            ]],
            ['qh','match','pattern'=>'/(201)\d{1}(0[0-9][0-9]|1[0-4][0-9]|15[0-5])$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qh' => '期号',
            'n1' => '号码1',
            'n2' => '号码2',
            'n3' => '号码3',
            'n4' => '号码4',
            'n5' => '号码5',
            'n6' => '号码6',
            'n7' => '号码7',
            'n8' => '特别号码',
        ];
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
    public function getKjhBD()
    {
        // 保存结果的二维数组
        $numbers = array();
        $snoopy = new Snoopy();

        // 得到网页内容
        $strBD = "http://trend.baidu.lecai.com/qlc/baseTrend.action?recentPhase=200&onlyBody=true";
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
}
