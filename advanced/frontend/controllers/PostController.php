<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 11:39
 */
namespace frontend\controllers;

use common\models\Cats;
use common\models\PostExtends;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Class PostController 文章控制器
 * @package frontend\controllers
 */
class PostController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create','upload','ueditor'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*'=>['get','post'],

                ],
            ],
        ];
    }
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
    public function actionIndex()
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
    /**
     * 文章展示
     */
    public function actionView($id){
        //文章统计
        $model=new PostExtends();
        $model->upCounter(['post_id'=>$id],'browser',1);
        $model=new PostForm();
        $data=$model->getViewById($id);

        return $this->render('view',['data'=>$data]);
    }



}


?>