<?php

namespace app\models;

use common\models\base\BaseModel;
use common\models\User;
use Yii;
use yii\base\Exception;

/**
 * This is the model class for table "feeds".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $content
 * @property integer $created_at
 */
class Feeds extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feeds';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'content' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getUser(){
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }


}
