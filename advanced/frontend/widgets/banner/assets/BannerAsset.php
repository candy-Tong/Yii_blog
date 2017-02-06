<?php
/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 */

namespace frontend\widgets\banner\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class BannerAsset extends AssetBundle
{
    public $css = [
        'css/htmleaf-demo.css',
        'css/normalize.css',
        'css/reset.css',
        'css/style.css',

    ];

    public $js = [
        'js/jquery-2.1.1.min.js',
        'dist/easySlider.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
}