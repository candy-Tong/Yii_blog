<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/8
 * Time: 16:02
 */
namespace frontend\models;

use app\models\Feeds;
use yii\base\Model;

class FeedForm extends Model{
    public $content;
    public $_lastError;

    public function rules()
    {
        return [
            ['content','required'],
            ['content','string','max'=>255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'content'=>'内容',
        ];
    }

    public function getList(){
        $model=new Feeds();
        $res=$model->find()
            ->limit(10)
            ->with('user')
            ->orderBy(['id'=>SORT_DESC])
            ->asArray()
            ->all();
        return $res?:[];
    }
}