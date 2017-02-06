<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/6
 * Time: 17:31
 */

namespace frontend\widgets\banner;
use Yii;
use yii\bootstrap\Widget;
use frontend\widgets\banner\assets\BannerAsset;

class BannerWidgets extends Widget
{
    public $item=[];
    public $change;
    public function init()
    {
        if(empty($this->item)) {
            $this->item = [
                [
                    'label' => 'demo',
                    'image_url' => '/static/images/banner/b_0.jpg',
                    'url' => ['site/index'],
                    'html' => '',
                    'active' => 'active',
                ],
                [
                    'label' => 'demo',
                    'image_url' => '/static/images/banner/b_1.jpg',
                    'url' => ['site/index'],
                    'html' => '',
                ],
                [
                    'label' => 'demo',
                    'image_url' => '/static/images/banner/b_2.jpg',
                    'url' => ['site/index'],
                    'html' => '',
                ],
            ];
        }
        $this->change=[
            'prev'=>[
                'image_url' => '/static/images/banner/prev.png',
            ],
            'next'=>[
                'image_url' => '/static/images/banner/next.png',
            ]
        ];
    }
    public function run()
    {
        $this->registerClientScript();
        $data['item']=$this->item;
        $data['change']=$this->change;
        return $this->render('index',['data'=>$data]);
    }

    /**
     * 引入css和js
     */
    public function registerClientScript()
    {
        BannerAsset::register($this->view);
    }
}