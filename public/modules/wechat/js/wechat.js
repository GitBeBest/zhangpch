/**
 * Created by pc on 2017/3/5.
 */
$(function () {
    $(window.location.hash).removeClass('weui-tab__content').siblings('.left-menu').addClass('weui-tab__content');

    $('.weui-navbar__item').each(function(){
        if($(this).attr('href') == window.location.hash) {
            $(this).addClass('weui-bar__item_on');
        }else{
            $(this).removeClass('weui-bar__item_on');
        }
    });

    $('.weui-navbar__item').on('click', function () {
        $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
        $($(this).attr('href')).removeClass('weui-tab__content').siblings('.left-menu').addClass('weui-tab__content');
    });

    //自定义菜单查询
    $('#menu-get').on('click', function () {
        $.ajax({

        });
    })
});