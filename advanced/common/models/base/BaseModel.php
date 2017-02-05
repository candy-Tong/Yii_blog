<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 12:24
 */
namespace common\models\base;
use yii\db\ActiveRecord;

/**
 * 基础模型
 */
class BaseModel extends ActiveRecord{
    public function getPages($query,$curPage=1,$pageSize=10,$search=null){
        if($search)
            $query=$query->andFileWhere($search);
        $data['count']=$query->count();
        if(!$data['count']){
            return [
                'count'=>0,                     //数据数目
                'curPage'=>$curPage,            //当前页数
                'pageSize'=>$pageSize,          //页面大小
                'start'=>0,                     //起始位置
                'end'=>0,                       //结束位置
                'data'=>[]                       //数据内容
            ];
        }
        //检查当前页是否超界，若 当前页>  总条数/页面大小 , 则页面超界，设为最末页
        $curPage=($curPage>ceil($data['count']/$pageSize))
            ?ceil($data['count']/$pageSize):$curPage;
        //当前页
        $data['curPage']=$curPage;
        //页面大小
        $data['pageSize']=$pageSize;
        //起始位置
        $data['start']=($curPage-1)*$pageSize+1;
        //结束位置，需要检查是否到文章末尾
        $data['end']=($curPage==ceil($data['count']/$pageSize))
            ?$data['count']:($curPage-1)*$pageSize+$pageSize;
        //文章内容
        $data['data']=$query
            ->offset(($curPage-1)*$pageSize)
            ->limit($pageSize)
            ->asArray()
            ->all();
        print_r($data);
       return $data;

    }
}