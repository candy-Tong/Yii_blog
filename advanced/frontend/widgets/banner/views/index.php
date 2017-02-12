<style>
    #content{
        width:1030px;
        margin-bottom:20px;
        margin:auto;}
    #imgauto{
        width:100%;
        height:510px;
        position:relative;
    }
    .img-con,.next,.pre,.backbg,.img-btn{
        display:block;
        position:absolute;}
    .img-con{
        left:40px;
        top:0;
        z-index:50;}
    .img-con a{
        display:none;}
    .next{
        left:985px;
        top:230px;
        z-index:99;}
    .pre{
        left:0;
        top:230px;
        z-index:98;}
    .backbg{
        width:925px;
        height:150px;
        left:40px;
        top:365px;
        z-index:1;
        background:url(<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/blackbg.png) no-repeat;
    }
    .img-btn{
        left:460px;
        top:440px;
        z-index:100;}
    .img-btn a{
        float:left;
        margin-right:10px;
        width:13px;
        height:13px;
        cursor:pointer;
        FILTER: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='img/imgautobtn1.png');
        background:url(<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/imgautobtn1.png) no-repeat;
    }
    .img-btn .img-btn-checked{
        background:url(<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/imgautobtn2.png) no-repeat;}


</style>
<div id="content">
    <div id="imgauto">
        <div class="img-btn">
            <a class="img-btn-checked"></a>
            <a></a>
            <a></a>
            <a></a>
        </div>
        <div class="img-con">
            <a style="display:block" href="#"><img src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/img_1.jpg" /></a>
            <a href="#"><img src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/img_2.jpg"/></a>
            <a href="#"><img src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/img_3.jpg"/></a>
            <a href="#"><img src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/img_4.jpg"/></a>
        </div>
<!--        <div id="backbg" class="backbg"></div>-->
        <a class="pre" href="javascript:void(0);"><img width="35px" height="52px" src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/pre.png" /></a>
        <a class="next" href="javascript:void(0);"><img width="35px" height="52px" src="<?=Yii::$app->params['f_widget_path']?>/banner/statics/img/next.png" /></a>
    </div><!--imgauto-->
</div>

