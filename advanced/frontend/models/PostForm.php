<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 12:57
 */
namespace frontend\models;

use common\Console;
use common\models\Posts;
use yii\base\Model;
use Yii;

/**
 * Class PostForm 文章表模型
 * @package frontend\models
 */
class PostForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;

    public $_lastError = "";

    /**
     * 定义场景
     * SCENARIO_CREATE  创建
     * SCENARIO_UPDATE  更新
     */
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public function scenarios()
    {
        $scenarios = [
            self::SCENARIO_CREATE =>[ 'title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIO_UPDATE =>[ 'title', 'content', 'label_img', 'cat_id', 'tags'],
        ];
        return array_merge(parent::scenarios(), $scenarios);
    }


    public function rules()
    {
        return [
            [['id', 'title', 'content', 'cat_id'], 'required'],
            [['id', 'cat_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'id'),
            'title' => Yii::t('common', 'title'),
            'content' => Yii::t('common', 'content'),
            'label_img' => Yii::t('common', 'label_img'),
            'tags' => Yii::t('common', 'tags'),
            'cat_id' => Yii::t('common', 'cat_id'),
        ];
    }

    /**
     * 文章创建
     * @return bool
     */
    public function create()
    {
        //事务
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = new Posts();
            //设置表单字段，表单原有的数据可以直接导入
            $model->setAttributes($this->attributes);
            //设置表单模型没有的字段，例如创建时间等，是系统自动填补的
            $model->summary = $this->_getSummary();
            $model->user_id = Yii::$app->user->identity->id;
            $model->user_name = Yii::$app->user->identity->username;
            $model->created_at = time();
            $model->updated_at = time();
//            Console::console($model->title);
            if (!$model->save()) {
                throw new \Exception(Yii::t('common', 'Save failed!'));
            }
            $this->id = $model->id;

            //调用事件
            $this->_eventAfterCreate();


            $transaction->commit();
            return true;
        } catch (\Exception  $e) {
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }

    /**
     * 截取文章摘要
     * @param int $begin    截取开始位置
     * @param int $end      截取结束位置
     * @param string $char  字符编码
     * @return null|string  无HTML标签的摘要
     */
    private function _getSummary($begin = 0, $end = 90, $char = 'utf-8')
    {
        if(empty($this->content))
            return null;
        return(mb_substr(str_replace('&nbsp;','',strip_tags($this->content)),$begin,$end,$char));
    }

    /**
     * 创建完成后调用的事件方法
     */

    private function _eventAfterCreate(){

    }




}