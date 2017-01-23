<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 11:40
 */
namespace frontend\controllers\base;

use yii\web\Controller;

/**
 * Class BaseController 基础控制器
 * @package frontend\controllers\base
 */
class BaseController extends Controller{
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)){
            return false;
        }
        return true;
    }
}