<?php
use frontend\widgets\banner\BannerWidgets;
/* @var $this yii\web\View */

$this->title = '博客-首页';
?>
<div class="row">
    <div class="col-lg-9">
        <?=BannerWidgets::widget();?>
    </div>
    <div class="col-lg-3">

    </div>
</div>
