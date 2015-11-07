<?php

namespace app\models;

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
}
