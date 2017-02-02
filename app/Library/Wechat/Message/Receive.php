<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2016/7/1
 * Time: 0:46
 */
namespace App\Library\Wechat\Message;

use App\Library\Wechat\WechatMessage;

class Receive extends WechatMessage
{
    private $msgType;

    public function __construct()
    {

    }

    /**
     * 文本消息
     */
    public function text()
    {
//        ToUserName	开发者微信号
//        FromUserName	发送方帐号（一个OpenID）
//        CreateTime	消息创建时间 （整型）
//        MsgType	text
//        Content	文本消息内容
//        MsgId	消息id，64位整型
    }

    /**
     * 图片消息
     */
    public function image()
    {
//        ToUserName	开发者微信号
//        FromUserName	发送方帐号（一个OpenID）
//        CreateTime	消息创建时间 （整型）
//        MsgType	image
//        PicUrl	图片链接
//        MediaId	图片消息媒体id，可以调用多媒体文件下载接口拉取数据。
//        MsgId	消息id，64位整型
    }

    /**
     * 语音消息
     */
    public function voice()
    {
//        ToUserName	开发者微信号
//        FromUserName	发送方帐号（一个OpenID）
//        CreateTime	消息创建时间 （整型）
//        MsgType	语音为voice
//        MediaId	语音消息媒体id，可以调用多媒体文件下载接口拉取数据。
//        Format	语音格式，如amr，speex等
//        MsgID	消息id，64位整型
    }

    /**
     * 视频消息
     */
    public function video()
    {
//        ToUserName	开发者微信号
//          FromUserName	发送方帐号（一个OpenID）
//            CreateTime	消息创建时间 （整型）
//            MsgType	视频为video
//            MediaId	视频消息媒体id，可以调用多媒体文件下载接口拉取数据。
//            ThumbMediaId	视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
//            MsgId	消息id，64位整型
    }

    /**
     * 小视频消息
     */
    public function shortvideo()
    {

    }

    /**
     * 地理位置消息
     */
    public function location()
    {

    }

    /**
     * 链接消息
     */
    public function link()
    {

    }
}