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
use common\models\RelationPostTags;
use yii\base\Model;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

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
    /**
     * EVENT_AFTER_CRESTE   创建后的事件
     * EVENT_AFTER_UPDATE   更新后的事件
     */
    const EVENT_AFTER_CREATE='eventAfterCreate';
    const EVENT_AFTER_UPDATE='eventAfterUpdate';

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
            if (!$model->save()) {
                throw new \Exception(Yii::t('common', 'Save failed!'));
            }
            $this->id = $model->id;

            //调用事件
            $data=array_merge($this->getAttributes(),$model->getAttributes());
            $this->_eventAfterCreate($data);


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
    private function _eventAfterCreate($data){
        //附加处理器到事件
        $this->on(self::EVENT_AFTER_CREATE,[$this,'_evenAddTag'],$data);
        //触发事件
        $this->trigger(self::EVENT_AFTER_CREATE);
    }

    public function _evenAddTag($event)
    {
        //保存标签
        $tag = new TagFrom();
        $tag->tags = $event->data['tags'];
        $tagids = $tag->saveTags();

        //删除原先的关联,全部 文章-标签 关联关系重新写入
        RelationPostTags::deleteAll(['post_id' => $event->data['id]']]);

        //批量保存 文章-标签 关联关系
        if (!empty($tagids)) {
            foreach ($tagids as $k => $id) {
                $row[$k]['post_id'] = $this->id;      //本篇文章的id
                $row[$k]['tag_id'] = $id;             //标签的id
            }
            //批量插入
            $res = (new Query())->createCommand()
                ->batchInsert(RelationPostTags::tableName(), ['post_id', 'tag_id'], $row)
                ->execute();
            if(!$res)
                throw new \Exception('关联关系保存失败');
        }
    }
    public function getViewById($id){
       $res= Posts::find()->with('relate.tag','extend')->where(['id'=>$id])->asArray()->one();
       if (!$res){
           throw new NotFoundHttpException('文章不存在！');
       }
       $res['tags']=[];
       if(isset($res['relate'])&&!empty($res['relate'])){
           foreach ($res['relate'] as $list){
               $res['tags'][]=$list['tag']['tag_name'];
           }
       }
       unset($res['relate']);
       return $res;
    }


    public static function getList($condition,$curPage=1,$pageSize=5,$orderBy=['id'=>SORT_DESC]){
        $model=new Posts();
        //查询语句
        $select=['id','title','summary','label_img','cat_id','user_id','user_name','is_valid','created_at',
        'updated_at'];
        $query=$model->find()
            ->select($select)
//            ->where($condition)
            ->with('relate.tag','extend')
            ->orderBy($orderBy);
        //获取分页数据
        $res=$model->getPages($query,$curPage,$pageSize);
        //格式化
        $res['data']=self::_formatList($res['data']);
        return $res;
    }

    /**
     * 数据格式化
     * @param $data
     */
    public static function _formatList($data){
        foreach ($data as &$list){          //加 & 因为需要改变$list
            $list['tags']=[];
            if (isset($list['relate'])&&!empty($list['relate'])){
                foreach ($list['relate'] as $lt){
                    $list['tags'][]=$lt['tag']['tag_name'];
                }
                unset($list['relate']);
            }
        }
        return $data;
    }
}