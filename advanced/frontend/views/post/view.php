<?php
/**
 * Created by PhpStorm.
 * User: candyTong
 * Date: 2017/2/2
 * Time: 23:36
 */
$this->title=$data['title'];
$this->params['breadcrumbs'][]=['label'=>'文章','url'=>['post/index']];
$this->params['breadcrumbs'][]=$this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="page-title">
            <h1><?=$data['title']?></h1>
            <span>作者:<?=$data['user_name']?></span>
            <span>发布:<?=date('Y-m-d',$data['created_at'])?></span>
            <span>浏览:<?=$data['extend']['browser']?></span>
        </div>
        <div class="page-content">
            <?=$data['content']?>
        </div>
        <div>
            标签:
            <?php foreach ($data['tags'] as $tag):?>
                <span><a href="#"><?=$tag?></a></span>
            <?php endforeach;?>
        </div>
    </div>

</div>
