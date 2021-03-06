<?php
use frontend\widgets\banner\BannerWidgets;
/* @var $this yii\web\View */

$this->title = '博客-首页';
?>
<div>
    <?=BannerWidgets::widget();?>
</div>
<div class="row">
    <div class="col-lg-9">
        <span>
            <?=\frontend\widgets\post\PostWidget::widget()?>
        </span>

    </div>
    <div class="col-lg-3">
        <?=\frontend\widgets\chat\ChatWidget::widget();?>
        <?=\frontend\widgets\hot\HotWidget::widget();?>
        <?=\frontend\widgets\tag\TagWidget::widget();?>
    </div>
</div>
