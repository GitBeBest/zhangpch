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
    });

    var WxJsApi = function () {

    };

    var version = "1.0.0";
    var hasOwn = {}.hasOwnProperty;
    var cfg = {
        'CURRENT_URL' : window.location.href,
        'SIGN_URL' : '/wechat/sign_package',
    },
        channels = {
            wx_pub: 'wx_pub',
            wx_pay_wap: 'wxpay_wap'
        };


    WxJsApi.prototype = {
        version: version,
        _resultCallBack: undefined,
        _jsApiParameters: {},
        _debug: false,
        _signature: undefined,

        jsBeforeApiCall: function() {
            var self = this;
            if(self._isEmptyObject(self._jsApiParameters)) {

            }else {
                $.ajax({
                    type: 'POST',
                    url: cfg.SIGN_URL,
                    data: {url: cfg.CURRENT_URL},
                    dataType: 'json',
                    success: function (data) {
                        self._jsApiParameters = data;
                        self._callApi();
                    }
                });
            }
        },
        _isEmptyObject: function(obj) {
            for(var key in obj){
                return true;
            }
            return false;
        },
        _callApi: function () {
            var self = this;
            wx.config({
                debug: self._debug, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: self._jsApiParameters.appId, // 必填，公众号的唯一标识
                timestamp: self._jsApiParameters.timestamp, // 必填，生成签名的时间戳
                nonceStr: self._jsApiParameters.nonceStr, // 必填，生成签名的随机串
                signature: self._jsApiParameters.signature,// 必填，签名，见附录1
                jsApiList: self._jsApiParameters.jsApiList // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });
        }
    };

    wx.ready(function () {
        wx.hideMenuItems({
            menuList: [
                "menuItem:share:timeline",
                "menuItem:share:qq"
            ]
        });
        // wx.showMenuItems({
        //     menuList: [
        //
        //     ] // 要显示的菜单项，所有menu项见附录3
        // });

        //使用微信内置地图查看位置接口
        // wx.openLocation({
        //     latitude: 0, // 纬度，浮点数，范围为90 ~ -90
        //     longitude: 0, // 经度，浮点数，范围为180 ~ -180。
        //     name: '', // 位置名
        //     address: '', // 地址详情说明
        //     scale: 1, // 地图缩放级别,整形值,范围从1~28。默认为最大
        //     infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
        // });
        // wx.chooseWXPay({
        //     timestamp: 0, // 支付签名时间戳，注意微信jssdk中的所有使用timestamp字段均为小写。但最新版的支付后台生成签名使用的timeStamp字段名需大写其中的S字符
        //     nonceStr: '', // 支付签名随机串，不长于 32 位
        //     package: '', // 统一支付接口返回的prepay_id参数值，提交格式如：prepay_id=***）
        //     signType: '', // 签名方式，默认为'SHA1'，使用新版支付需传入'MD5'
        //     paySign: '', // 支付签名
        //     success: function (res) {
        //         // 支付成功后的回调函数
        //     }
        // });
        // //分享到QQ
        // wx.onMenuShareQQ({
        //     title: '你的时间你做主', //分享标题
        //     desc: '一个神奇的网站,No58', //分享描述
        //     link: 'http://music.163.com/#/song?id=27904398', //分享链接
        //     imgUrl: '', //分享图标
        //     success: function(){
        //
        //     },
        //     cancel: function() {
        //
        //     }
        // });
        //
        // //分享到腾讯微博
        // wx.onMenuShareWeibo({
        //     title: '', //分享标题
        //     desc: '', //分享描述
        //     link: '', //分享链接
        //     imgUrl: '', //分享图标
        //     success: function () {
        //
        //     },
        //     cancel: function () {
        //
        //     }
        // });
        //
        // //分享到QQ空间
        // wx.onMenuShareQZone({
        //     title: '', //分享标题
        //     desc: '', //分享描述
        //     link: '', //分享链接
        //     imgUrl: '', //分享图标
        //     success: function () {
        //
        //     },
        //     cancel: function () {
        //
        //     }
        // });
        //
        // //分享到朋友圈
        // wx.onMenuShareTimeline({
        //     title: '', //分享标题
        //     link: '', //分享链接
        //     imgUrl: '', //分享图标
        //     success: function(){
        //
        //     },
        //     cancel: function () {
        //
        //     }
        // });
        //
        // //分享给朋友
        // wx.onMenuShareAppMessage({
        //     title: '', //分享标题
        //     desc: '', //分享描述
        //     link: '', //分享链接
        //     imgUrl: '', //分享图标
        //     type: '', //分享类型,music\video\link,默认link
        //     dataUrl: '', //如果type是music或video，则要提供数据链接，默认为空
        //     success: function() {
        //
        //     },
        //     cancel: function(){
        //
        //     }
        // });
        //
        // wx.getLocation({
        //     type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
        //     success: function (res) {
        //         var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
        //         var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
        //         var speed = res.speed; // 速度，以米/每秒计
        //         var accuracy = res.accuracy; // 位置精度
        //     }
        // });

        //wx.showAllNonBaseMenuItem();
    });

    wx.error(function (res) {

    });
    // 发送给朋友: "menuItem:share:appMessage"
    // 分享到朋友圈: "menuItem:share:timeline"
    // 分享到QQ: "menuItem:share:qq"
    // 分享到Weibo: "menuItem:share:weiboApp"
    // 收藏: "menuItem:favorite"
    // 分享到FB: "menuItem:share:facebook"
    // 分享到 QQ 空间/menuItem:share:QZone
    window.wxjsapi = new WxJsApi();
    window.wxjsapi.jsBeforeApiCall();
});