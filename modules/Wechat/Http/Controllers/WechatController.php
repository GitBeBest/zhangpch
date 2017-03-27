<?php namespace Modules\Wechat\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Modules\Wechat\Http\Requests\UserService;
use Modules\Wechat\Http\Requests\WechatUtil;
use Pingpong\Modules\Routing\Controller;

class WechatController extends Controller {
	
	public function index()
	{
		//if($this->checkSignature()) {
            //$echoStr = $_GET["echostr"];
			//echo $echoStr;
			//exit;
		//} else {
			//exit;
		//}

        $message = file_get_contents("php://input");
        $message = simplexml_load_string($message, 'SimpleXMLElement', LIBXML_NOCDATA);
        $view = 'wechat::message.text';
        $message->Content = '你好，请问有什么可以为你服务？';
        switch($message->MsgType) {
//            case 'text':
//                $message->Content = '你好，请问有什么可以为你服务？';
//                break;
//            case 'image':
//                $view = 'wechat::message.image';
//                break;
//            case 'music':
//                $view = 'wechat::message.music';
//                break;
//            case 'voice':
//                $view = 'wechat::message.voice';
//                break;
//            case 'video':
//                $view = 'wechat::message.video';
//                break;
//            case 'news':
//                $view = 'wechat::message.news';
//                break;
            case 'event':
                //关注事件
                if($message->Event == 'subscribe') {
                    $message->Content = '感谢关注鹏程的微信订阅号！';
                }elseif($message->Event == 'unsubscribe'){ //取消关注
                    $message->Content = '感谢关注鹏程的微信订阅号！';
                }
                break;
            default:
                break;
        }
        return view($view, ['message' => $message]);
	}

    /**
     * 更新access_token
     */
	public function updateAT() {
        $util = new WechatUtil();
        $result = $util->updateAccessToken();
        if ($result) {
            return ['status' => 'ok', 'errMsg' => '更新成功！'];
        }

        return ['status' => 'no', 'errMsg' => '更新失败！'];

    }

	public function oauth() {
	    $open_id = session('wx.program.openid');
	    $service = new UserService();
	    $user = $service->getUserByOpenId($open_id);
	    if($user) {
	        echo $user->nickname. '你好';
        }else{
	        echo '未获取到信息';
        }
        exit;
    }

    /**
     * 获取微信js配置
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSignPackage() {
        $url = \Request::input('url'); //当前网页url
        $config = \Config::get('wechat');
        $timestamp = time();
	    $data = [
	        'appId' => $config['appID'], //公众号唯一标示
            'timestamp' => $timestamp, //签名时间戳
            'nonceStr' => '', //签名随即串
            'signature' => '', //签名
            'jsApiList' => []
        ];
	    $service = new UserService();
	    $data['nonceStr'] = $service->generateNonce(8);
	    $util = new WechatUtil();
	    $ticket = $util->getJsTicket();
	    $sign_str = 'jsapi_ticket='.$ticket. '&noncestr='. $data['nonceStr']. '&timestamp='.$timestamp.'&url='.$url;
	    $sign_str = sha1($sign_str);
	    $data['signature'] = $sign_str;
	    $data['jsApiList'] = $config['validJsApi'];
	    return response()->json($data);

    }

    /**
     * 管理
     */
	public function manage() {
		return view("wechat::manage");
	}

    /**
     * 验证合法性
     * @return bool
     */
	private function checkSignature()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];

		$config = \Config::get('wechat');
		if(!isset($config['Token'])) {
			throw new Exception('TOKEN is not defined!');
		}
		$token = $config['Token'];
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );

		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * 接收消息
	 */
	public function getMessage()
	{
		$username = Input::get('ToUserName ');
		$fromUserName = Input::get('FromUserName ');
		$createTime = Input::get('CreateTime');
		$msgType = Input::get('MsgType');
		$content = Input::get('Content');
		$msgId = Input::get('MsgId');

		file_put_contents('/tmp/wechat/msg', 'msgid:'.$msgType.' content:'.$content);
	}

    /**
     * 生成二维码
     */
    public function accountQrCode() {
        $open_id = session('wx.program.openid');
        $service = new UserService();
        $user = $service->getUserByOpenId($open_id);
        $util = new WechatUtil();
        //0 临时 1 永久
        $ticket = $util->createQrCode(0, $user->id);
        if(empty($ticket)) {
            return response()->json(['暂时无法生成二维码']);
        }
        $util->getQrCode($ticket);
    }
}