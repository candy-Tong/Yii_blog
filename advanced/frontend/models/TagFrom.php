<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/27
 * Time: 22:08
 */

namespace frontend\models;


use common\models\Tags;
use yii\base\Exception;
use yii\base\Model;

class TagFrom extends Model
{
    public $id;
    public $tags;
    public function rule(){
        return [
            ['tags','require'],
            ['tags','each','rule'=>['create']],
        ];
    }

    /**
     * 保存标签集合
     * @return array 返回标签集合
     */
    public function saveTags(){
        $ids=[];
        if(!empty($this->tags)){
            foreach ($this->tags as $tag){
                $ids[]=$this->_saveSingleTag($tag);
            }
        }
        return $ids;
    }

    /**
     * 保存单个标签
     * @return mixed 返回单个标签
     */
    private function _saveSingleTag($tag){
        $model=new Tags();
        $res=$model->find()->where(['tag_name'=>$tag])->one();
        //新建标签
        if(!$res){
            $model->tag_name=$tag;
            $model->post_num=1;
            if(!$model->save()){
                throw new \Exception("保存标签失败");
            }
            return $model->id;
        }else{
            $res->updateCounters(['post_num'=>1]);
        }

        return $res->id;
    }
}