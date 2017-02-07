/**
 * Created by zpc on 17-2-6.
 */
$(document).ready(function(){
    $("#art-cate-menu li>a").click(function (e) {
        var index = $(this).attr('tabindex');
        var title = $(this).html();
        $("#art-cate-title").attr('value', title);
        $("#art-category").attr('value', index);
    });

    $("#art-img").change(function(){
        $("#art-img-pre").attr('src', $(this).val())
    });

    var validator = $("#art-form").validate({
        rules: {
            title: {
                required: true,
                maxlength: 55
            },
            resume: {
                required: true,
                maxlength: 255
            },
            content: {
                required: true
            },
            category: {
                required: true
            },
            link_img: {
                required: true,
                url: true
            }
        },
        messages: {
            title: {
                required: "请输入文章标题",
                maxlength: $.validator.format("标题不能超过{0}个字符")
            },
            resume: {
                required: "请输入摘要"
            },
            content: {
                required: "请输入内容"
            },
            category: {
                required: "请选择分类"
            },
            link_img: {
                required: "请添加内容",
                url: "请输入正确的图片地址"
            }
        }
    });

    function submitArt(status) {
        var success = validator.form();
        if(success === true) {
            var title = $("#art-title").val();
            var resume = $("#art-resume").val();
            var content = $("#art-content").val();
            var cate = $("#art-category").val();
            var img = $("#art-img").val();
            $.ajax({
                url: '/admin/article/add',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'title' : title,
                    'resume' : resume,
                    'content': content,
                    'category' : cate,
                    'link_img' : img,
                    'status' : status
                },
                success: function(data){
                    if(data.status == 'ok'){
                        window.location.href="/admin/1";
                    }
                },
                error: function(data){

                }
            });
        }
    }
    $("#art-publish").click(function(){
        submitArt(1);
    });

    $("#art-store").click(function(){
        submitArt(0);
    });
});