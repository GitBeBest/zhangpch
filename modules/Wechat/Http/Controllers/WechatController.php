<?php namespace Modules\Wechat\Http\Controllers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Modules\Wechat\Http\Requests\UserService;
use PhpParser\Serializer\XML;
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
	
}