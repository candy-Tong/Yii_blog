/**
 *
 */
$(function () {
    //最新文章
    $(".J_lastTime ul li").eq(0).addClass("hov");
    $(".J_lastTime ul li").hover(function(){
        var id = $(this).index();
        $(".J_lastTime ul li").removeClass("hov").eq(id).addClass("hov");
    })

    //说一说
    $(".j-feed").click(function(){
        var url = $(this).attr("data-url");
        var content = $("textarea").val(); //获取文本框内容

        if(content == ''){
            $(".field-feed-content").addClass("has-error");
            return false;
        }


        $.ajax(url,{
            type:"post",
            dataType:"json",
            data:{ content:content },
            success:function(data){
                if(data.status){
                    location.reload();
                }else{
                    alert(data.msg);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);   // 200    
                alert(textStatus);
                alert(errorThrown);  // SyntaxError: Unexpected end of input    
            }
        })
    })
});