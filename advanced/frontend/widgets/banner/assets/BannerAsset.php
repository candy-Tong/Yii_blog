<?php
/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 */

namespace frontend\widgets\banner\assets;

use Yii;
use yii\web\View;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class BannerAsset extends AssetBundle
{
    public $css = [
        'css/style.css',
    ];

    public $js = [
        'js/jquery-2.1.1.min.js',
        'js/imgAuto.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];  // 这是设置所有js放置的位置

    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
    //定义按需加载css方法，注意加载顺序在最后
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [BannerAsset::className(), 'depends' => 'frontend\widgets\banner\assets\BannerAsset']);
    }
}