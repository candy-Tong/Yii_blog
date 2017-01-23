<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/1/21
 * Time: 15:19
 */
use yii\bootstrap\ActiveForm;

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' => '文章', 'url' => ['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]); ?>
            <?= $form->field($model, 'cat_id')->dropDownList($cat); ?>

            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload', [
                'config' => [
                    //图片上传的一些配置，不写调用默认配置
                    'domain_url' => '/imooc/Yii_blog/advanced/frontend/web',
                ]
            ]) ?>

            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor', [
                'options' => [
                    'initialFrameHeight' => 400,
                    'domain_url' => '/imooc/Yii_blog/advanced/frontend/web',
                ]
            ]) ?>

            <?= $form->field($model, 'tags')->widget('common\widgets\tags\TagWidget'); ?>

            <div class="form-group">
                <?= \yii\bootstrap\Html::submitButton(Yii::t('common', 'Release'), ['class' => 'btn btn-success']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>
        </div>
        <div class="panel-body">
            <p>1.啦啦啦</p>
            <p>2.那你很棒哦</p>
        </div>
    </div>

</div>

