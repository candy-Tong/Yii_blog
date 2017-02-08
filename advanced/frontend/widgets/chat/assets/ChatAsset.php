<?php
/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 */

namespace frontend\widgets\chat\assets;

use Yii;
use yii\web\View;
use yii\web\AssetBundle;

/**
 * @author Xianan Huang <xianan_huang@163.com>
 */
class ChatAsset extends AssetBundle
{
    public $css = [
        'css/style.css',
    ];

    public $js = [

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

}