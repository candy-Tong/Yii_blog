
<div id="slider">
    <ul class="slides clearfix">
        <li><img class="responsive" src="<?=\Yii::$app->params['upload_url'].$data['item'][0]['image_url']?>"></li>
        <li><img class="responsive" src="<?=\Yii::$app->params['upload_url'].$data['item'][1]['image_url']?>"></li>
        <li><img class="responsive" src="<?=\Yii::$app->params['upload_url'].$data['item'][2]['image_url']?>"></li>
        <li><img class="responsive" src="<?=\Yii::$app->params['upload_url'].$data['item'][2]['image_url']?>"></li>
    </ul>
    <ul class="controls">
        <li><img src="<?=\Yii::$app->params['upload_url'].$data['change']['prev']['image_url']?>" alt="previous"></li>
        <li><img src="<?=\Yii::$app->params['upload_url'].$data['change']['next']['image_url']?>" alt="next"></li>
    </ul>
    <ul class="pagination">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>



<script type="text/javascript">
    $(function() {
        $("#slider").easySlider( {
            slideSpeed: 500,
            paginationSpacing: "15px",
            paginationDiameter: "12px",
            paginationPositionFromBottom: "20px",
            slidesClass: ".slides",
            controlsClass: ".controls",
            paginationClass: ".pagination"
        });
    });
</script>

