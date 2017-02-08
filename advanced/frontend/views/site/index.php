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
        <?=\frontend\widgets\chat\ChatWidget::widget();?>
    </div>
    <div class="col-lg-3">

    </div>
</div>
