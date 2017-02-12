<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/8
 * Time: 16:05
 */
namespace frontend\widgets\chat;

use frontend\models\FeedForm;
use Yii;
use yii\base\Widget;
use frontend\widgets\chat\assets\ChatAsset;

class ChatWidget extends Widget{

    public function run()
    {
        //载入该组件的 css 和 js
        $this->registerClientScript();
        $feed=new FeedForm();
        $data['feed']=$feed->getList();
        return $this->render('index',['data'=>$data]);
    }
    /**
     * 引入css和js
     */
    public function registerClientScript()
    {
        ChatAsset::register($this->view);
    }
}