<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 */
class PostExtends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'browser' => Yii::t('app', 'Browser'),
            'collect' => Yii::t('app', 'Collect'),
            'praise' => Yii::t('app', 'Praise'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * 更新文章统计
     * @param $condition 条件
     * @param $attibute 属性值
     * @param $num 自增数值
     */
    public function upCounter($condition,$attibute,$num){
        $counter=$this->findOne($condition);
        if(!$counter){
            //根据$condition生成一个属性
            //$conditon 为一个数组，
            //生成格式为 数组名 = 数组值,如 $this->post_id=$id
            $this->setAttributes($condition);
            $this->$attibute=$num;              //设置某个属性的初值，如 $this->browser=1
            $this->save();
        }else{
            $countData[$attibute]=$num;
            //$countData 为一个数组
            //使 $counter 数组名对应的数据库字段 增加 数组值对应的值
            $counter->updateCounters($countData);
        }

    }
}
