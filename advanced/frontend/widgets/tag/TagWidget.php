<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/13
 * Time: 15:08
 */
namespace frontend\widgets\tag;


use common\models\Tags;
use frontend\widgets\tag\assets\TagAsset;
use yii\bootstrap\Widget;

class TagWidget extends Widget
{
    public $title = '';
    public $limit = 20;

    public function run()
    {
        $this->registerClientScript();
        $res = Tags::find()
            ->orderBy(['post_num' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        $result['title'] = $this->title?:"标签云";
        $result['body'] = $res;
        return $this->render('index', ['data' => $result]);
    }

    public function registerClientScript()
    {
        TagAsset::register($this->view);
    }

}