<?php namespace Modules\Wechat\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Pingpong\Modules\Routing\Controller;

class WechatController extends Controller {
	
	public function index()
	{
		$echoStr = $_GET["echostr"];
		if($this->checkSignature()) {
			echo $echoStr;
			exit;
		} else {
			exit;
		}
		//return view('wechat::index');
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