<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-9
 * Time: 下午4:48
 */

namespace Modules\Wechat\Http\Controllers;


use App\Http\Controllers\Controller;

class PayController extends Controller
{
    /**
     * 统一下单
     */
    public function doPay() {
        $data = [
            'appid' => '', //公众帐号ID
            'mch_id' => '', //商户号
            'device_info' => '', //设备号,自定义
            'nonce_str' => '', //随机字符串
            'sign' => '', //签名
            'sign_type' => '', //签名类型,默认MD5
            'body' => '', //商品描述
            'detail' => [ //商品详情
                'cost_price' => 208800, //订单原价2088.00
                'receipt_id' => 'zpc123', //商家小票
                'goods_detail' => [
                    [
                        'goods_id' => 'zpc_123_234', //商品编号
                        'wxpay_goods_id' => '1001', //微信支付定义的商品编号
                        'goods_name' => 'iPhone6s', //商品名称
                        'quantity' => 1, //商品数量
                        'price' => 528800, //商品单价
                    ],
                    [
                        'goods_id' => 'zpc_123_234', //商品编号
                        'wxpay_goods_id' => '1002', //微信支付定义的商品编号
                        'goods_name' => 'iPhone6s', //商品名称
                        'quantity' => 1, //商品数量
                        'price' => 528800, //商品单价
                    ]
                ]
            ],
            'attach' => '上海分店', //附加数据
            'out_trade_no' => '20150806125346', //商户订单号
            'fee_type' => 'CNY', //标价币种
            'total_fee' => '', //订单总金额
            'spbill_create_ip' => '123.12.45.62', //终端IP
            'time_start' => '20091225091010', //交易起始时间
            'time_expire' => '20091227091010', //交易结束时间
            'goods_tag' => 'WXG', //商品标记
            'notify_url' => '', //通知地址
            'trade_type' => 'JSAPI', //交易类型
            'product_id' => '', //商品ID
            'limit_pay' => '', //指定支付方式
            'openid' => '', //用户标识
        ];
    }

    /**
     * 查询订单
     */
    public function query(){
        $data = [
            'appid' => '', //公众帐号ID
            'mch_id' => '', //商户号
            'transaction_id' => '', //微型订单号
            'out_trade_no' => '', //商户订单号,二选一
            'nonce_str' => '', //随机字符串
            'sign' => '', //签名
            'sign_type' => '', //签名类型
        ];
    }

    /**
     * 关闭订单
     */
    public function close() {
        $data = [
            'appid' => '', //公众帐号ID
            'mch_id' => '', //商户号
            'out_trade_no' => '', //商户订单号,二选一
            'nonce_str' => '', //随机字符串
            'sign' => '', //签名
            'sign_type' => '', //签名类型
        ];
    }

    /**
     * 申请退款
     */
    public function refund() {
        $data = [
            'appid' => '', //公众帐号ID
            'mch_id' => '', //商户号
            'device_info' => '', //终端设备号
            'nonce_str' => '', //随机字符串
            'sign' => '', //签名
            'sign_type' => '', //签名类型
            'transaction_id' => '', //微型订单号
            'out_trade_no' => '', //商户订单号,二选一
            'out_refund_no' => '', //商户退款单号
            'total_fee' => 25800, //订单金额
            'refund_fee' => 528000,  //退款金额
            'refund_fee_type' => 'CNY', //货币种类
            'op_user_id' => '', //操作员
            'refund_account' => '' //退款资金来源
        ];
    }
}