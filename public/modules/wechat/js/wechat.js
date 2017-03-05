/**
 * Created by pc on 2017/3/5.
 */
$(function () {
    $('.weui-navbar__item').on('click', function () {
        $(this).addClass('weui-bar__item_on').siblings('.weui-bar__item_on').removeClass('weui-bar__item_on');
        $("."+$(this).attr('content_id')).removeClass('left-un-display').siblings('.left-menu').addClass('left-un-display');
    });
});