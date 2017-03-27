<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-9
 * Time: 下午5:03
 */

namespace Modules\Wechat\Http\Requests;


class PayApi
{
    //统一下单接口
    const API_PAY = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
    //查询订单
    const API_QUERY = 'https://api.mch.weixin.qq.com/pay/orderquery';
    //关闭订单
    const API_CLOSE = 'https://api.mch.weixin.qq.com/pay/closeorder';
    //申请退款
    const API_REFUND = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
    //查询退款
    const API_REFUND_QUERY = 'https://api.mch.weixin.qq.com/pay/refundquery';
    //下载对帐单
    const API_DOWNLOAD_BILL = 'https://api.mch.weixin.qq.com/pay/downloadbill';
    //支付结果通知
    //交易保障
    const API_REPORT = 'https://api.mch.weixin.qq.com/payitil/report';
}