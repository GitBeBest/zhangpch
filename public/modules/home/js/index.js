/**
 * Created by zpc on 17-2-27.
 */
$(document).ready(function(){
    $(".article-page ul li.num").click(function () {
        var index = $(this).html();
    });

    $("#up-enable").click(function () {
        $.ajax({
            headers: {
              'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
            },
            url: '../praise',
            type: 'POST',
            data: { id: $("#publish-art").attr('article_id')},
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'ok'){
                    $("#span-up-num").text(data.result.times);
                }
            },
            error: function (data) {

            }
        });
    });

    $("#down-enable").click(function () {
        $.ajax({
            headers: {
                'X-XSRF-TOKEN': $.cookie('XSRF-TOKEN')
            },
            url: '../hate',
            type: 'POST',
            data: { id: $("#publish-art").attr('article_id')},
            dataType: 'JSON',
            success: function (data) {
                if(data.status == 'ok'){
                    $("#span-down-num").text(data.result.times);
                }
            },
            error: function (data) {

            }
        });
    });
});