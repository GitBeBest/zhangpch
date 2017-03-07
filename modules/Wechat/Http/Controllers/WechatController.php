<?php namespace Modules\Wechat\Http\Controllers;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Modules\Wechat\Http\Requests\UserService;
use Modules\Wechat\Http\Requests\WechatUtil;
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
     * 获取自定义菜单
     */
	public function getMenu() {
        $util = new WechatUtil();
        $data = $util->getMenu();
        return response()->json($data);
    }

    /**
     * 添加自定义菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function addMenu() {
        $menu = [
            'button' => [
                [
                    'type' => 'pic_sysphoto',
                    'name' => '拍照',
                    'key' => 'zpc_menu_photo_V1'
                ],
                [
                    'name' => '一级菜单',
                    'sub_button' => [
                        [
                            'type' => 'view',
                            'name' => '欢迎',
                            'url' => 'http://www.gengdada.com/wechat/oauth'
                        ],
                        [
                            'type' => 'location_select',
                            'name' => '位置',
                            'key' => 'zpc_menu_location_V1'
                        ],
                        [
                            'type' => 'view',
                            'name' => '我的二维码',
                            'url' => 'http://www.gengdada.com/wechat/account_qr_code'
                        ]
                    ]
                ]
            ]
        ];

        $util = new WechatUtil();
        $result = $util->addMenu(json_encode($menu, JSON_UNESCAPED_UNICODE));
        $message = $result ? '添加成功!' : '添加失败!';
        return response()->json(['result'=> $message]);
    }

    /**
     * 删除自定义菜单
     * @return \Illuminate\Http\JsonResponse
     */
    public function delMenu() {
        $util = new WechatUtil();
        $result = $util->delMenu();
        $message = $result ? '删除成功!' : '删除失败!';
        return response()->json(['result'=> $message]);
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