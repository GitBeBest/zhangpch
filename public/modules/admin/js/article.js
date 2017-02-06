/**
 * Created by zpc on 17-2-6.
 */
$(document).ready(function(){
    $("#art-cate-menu li>a").click(function (e) {
        var index = $(this).attr('tabindex');
        var title = $(this).html();
        $("#art-cate-title").attr('value', title);
        $("#art-cate-index").attr('value', index);
    });

    $("#art-form button").click(function(){
        var title = '';
        var resume = '';
        var content = '';
        var cate = '';
        $.ajax({
            url: '/admin/article/add',
            type: 'POST',
            dataType: 'JSON',
            data: {
                'title' : title,
                'resume' : resume,
                'content': content,
                'category' : cate
            },
            success: function(data){

            },
            error: function(data){

            }
        });
    });
});