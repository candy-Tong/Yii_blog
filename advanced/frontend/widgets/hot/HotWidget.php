<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/13
 * Time: 11:42
 */
namespace frontend\widgets\hot;

use common\models\PostExtends;
use common\models\Posts;
use frontend\widgets\hot\assets\HotAsset;
use yii\base\Widget;
use yii\db\Query;

class HotWidget extends Widget{
    public $title='';
    public $limit=6;

    public function run()
    {
        //加载 css 和 js
        $this->registerClientScript();
        $res=(new Query())
            ->select('a.browser,b.id,b.title')
            ->from(['a'=>PostExtends::tableName()])
            ->join('LEFT JOIN',['b'=>Posts::tableName()],'a.post_id=b.id')
            ->orderBy(['browser'=>SORT_DESC,'id'=>SORT_DESC])
            ->limit($this->limit)
            ->all();
        $result['title']=$this->title?:'热门浏览';
        $result['body']=$res?:[];
        return $this->render('index',['data'=>$result]);
    }
    public function registerClientScript()
    {
        HotAsset::register($this->view);
    }
}