<?php namespace Modules\Wechat\Http\Controllers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Modules\Wechat\Http\Requests\UserService;
use Pingpong\Modules\Routing\Controller;

class WechatController extends Controller {
	
	public function index()
	{
		if($this->checkSignature()) {
            $echoStr = $_GET["echostr"];
			echo $echoStr;
			exit;
		} else {
			exit;
		}
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