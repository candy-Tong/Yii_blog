<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 11:39
 */
namespace frontend\controllers;

use common\models\Cats;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use Yii;

/**
 * Class PostController 文章控制器
 * @package frontend\controllers
 */
class PostController extends BaseController
{

    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',//这里扩展地址别写错
                'config' => ['imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",]
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix' => "",/*?图片访问路径前缀?*/
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",/*?上传保存路径,可以自定义保存路径和文件名格式?*/
                ]
            ]
        ];
    }

    /**
     * 文章列表
     */
    public
    function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new PostForm();
        //定义场景
        $model->setScenario(PostForm::SCENARIO_CREATE);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->create()) {
                Yii::$app->session->setFlash('warning', $model->_lastError);
            } else {
                return $this->redirect(['post/view', 'id' => $model->id]);
            }
        }
        //获取所有分类
        $cat = Cats::getAllCats();
        return $this->render('create', ['model' => $model, 'cat' => $cat]);   //将表单模型作为参数传到视图，将表单模型跟视图绑定

    }
    public  function actionTest(){
        $test=['message'=>'ASDF'];
        echo json_encode($test);
    }
}


?>