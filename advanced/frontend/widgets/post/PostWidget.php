<?php
/**
 * 文章列表组件
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/3
 * Time: 21:56
 */
namespace frontend\widgets\post;
use Codeception\Util\Uri;
use common\models\Posts;
use frontend\models\PostForm;
use Yii;
use yii\base\Widget;
use yii\data\Pagination;
use yii\helpers\Url;

class PostWidget extends Widget{
    //显示标题
    public $title='';
    //显示条数
    public $limit=6;
    //是否显示更多
    public $more=true;
    //是否显示分页
    public $page=true;

    public function run()
    {
        $curPage=Yii::$app->request->get('page',1);
        //查询条件
        $conditon=['=','is_valid',Posts::IS_VALID];
        $res=PostForm::getList($conditon,$curPage,$this->limit);
        $result['title']=$this->title?:'最新文章';
        $result['more']=Url::to(['post/index']);
        $result['body']=$res['data']?:[];
        //是否显示分页
        if($this->page){
            $pages=new Pagination(['totalCount'=>$res['count'],'pageSize'=>$res['pageSize']]);
            $result['page']=$pages;
        }
        return  $this->render('index',['data'=>$result]);
    }
}