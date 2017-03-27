<?php
namespace Modules\Wechat\Http\Requests;
use Illuminate\Http\Request;
use Modules\Wechat\Entities\AccessToken;
use Modules\Wechat\Entities\QrCode;

/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-2
 * Time: 下午5:19
 */
class WechatUtil
{
    private $config;

    public function __construct()
    {
        $this->config = \Config::get('wechat');
    }

    /**
     * curl get 请求
     * @param $url
     * @return mixed
     */
    public function curlGet($url) {
        $ch = curl_init();
        //设置超时
        //curl_setopt($ch, CURLOPT_TIMEOUT, $this->curl_timeout);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //运行curl，结果以jason形式返回
        $res = curl_exec($ch);
        curl_close($ch);
        //取出openid
        $data = json_decode($res,true);
        return $data;
    }

    /**
     * curl post 请求
     * @param $url
     * @param $data
     * @return mixed
     */
    public function curlPost($url, $data) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        curl_close($curl);
        return json_decode($result, true);
    }

    /**
     * curl 上传文件
     * @param $url
     * @param $path
     * @param $file_type
     * @return mixed
     */
    public function curlUpload($url, $path) {
        $curlPost = array('file' => '@' . realpath($path));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1); //POST提交
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    /**
     * 微信api请求access_token
     * @return mixed
     */
    private function apiForAccessToken() {
        $api_url = WechatApi::API_HOST.WechatApi::API_ACCESS_TOKEN;
        $patterns = ['/appid=@/', '/secret=@/'];
        $fills = ['appid='.$this->config['appID'], 'secret='.$this->config['appsecret']];
        $wx_url = preg_replace($patterns, $fills,  $api_url);
        $data = $this->curlGet($wx_url);
        return $data;
    }

    /**
     * 微型请求获取Jsticket
     * @return mixed
     */
    private function apiForJsTicket() {
        $api_url = WechatApi::API_HOST.WechatApi::API_GET_JS_TICKET;
        $access_token = $this->getAccessToken();
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='.$access_token];
        $wx_url = preg_replace($patterns, $fills,  $api_url);
        $data = $this->curlGet($wx_url);
        return $data;
    }

    /**
     * 获取jsapiticket
     * @return string
     */
    public function getJsTicket() {
        $js_ticket = '';
        $model = AccessToken::where(['appid' => $this->config['appID']])->first();
        if(empty($model)) {
            //请求接口获取
            $model = new AccessToken();
            $data = $this->apiForJsTicket();
            if(isset($data['ticket'])) {
                $js_ticket = $data['ticket'];
                $model->dev_id = $this->config['devID'];
                $model->appid = $this->config['appID'];
                $model->jsapi_ticket = $data['ticket'];
                $model->expires_in = $data['expires_in'];
                $model->save();
            }
        }else{
            if(empty($model->jsapi_ticket)) {
                $data = $this->apiForJsTicket();
                if(isset($data['ticket'])) {
                    $js_ticket = $data['ticket'];
                    $model->jsapi_ticket = $data['ticket'];
                    $model->save();
                }
            }else{
                $js_ticket = $model->jsapi_ticket;
            }
        }

        return $js_ticket;
    }

    /**
     * 获取access_token
     * @return string
     */
    public function getAccessToken() {
        //先从数据库获取
        $access_token = '';
        $model = AccessToken::where(['appid' => $this->config['appID']])->first();
        if(empty($model)) {
            //请求接口获取
            $model = new AccessToken();
            $data = $this->apiForAccessToken();
            if(isset($data['access_token'])) {
                $access_token = $data['access_token'];
                $model->dev_id = $this->config['devID'];
                $model->appid = $this->config['appID'];
                $model->access_token = $data['access_token'];
                $model->expires_in = $data['expires_in'];
                $model->save();
            }
        }else{
            if(empty($model->access_token)) {
                $data = $this->apiForAccessToken();
                if(isset($data['access_token'])) {
                    $access_token = $data['access_token'];
                    $model->access_token = $data['access_token'];
                    $model->save();
                }
            }else{
                $access_token = $model->access_token;
            }
        }

        return $access_token;
    }

    /**
     * 更新access_token(应该2小时更新一次)
     * @return bool
     */
    public function updateAccessToken() {
        $model = AccessToken::where(['appid' => $this->config['appID']])->first();
        if ($model) {
            $data = $this->apiForAccessToken();
            if(isset($data['access_token'])) {
                $model->access_token = $data['access_token'];
                $model->save();
                return true;
            }
        }
        return false;
    }


    /**
     * 获取code
     * @param $redirect_url
     * @param string $scope
     * @param int $state
     */
    public function getOauthCode($redirect_url, $scope = 'snsapi_base', $state=1234) {
        $api_url = WechatApi::OAUTH_HOST . WechatApi::OAUTH_CODE;
        $patterns = ['/appid=@/', '/redirect_uri=@/', '/scope=@/', '/state=@/'];
        $fills = ['appid='.$this->config['appID'], 'redirect_uri='.$redirect_url, 'scope='.$scope, 'state='.$state];
        $wx_url = preg_replace($patterns, $fills,  $api_url);
        header('Location:'. $wx_url);
        exit;
    }

    /**
     * 通过code换取access_token
     * @param $code
     * @return mixed
     */
    public function getOpenId($code) {
        $api_url = WechatApi::API_HOST . WechatApi::ACCESS_TOKEN;
        $patterns = ['/appid=@/', '/secret=@/', '/code=@/'];
        $fills = ['appid='.$this->config['appID'], 'secret='.$this->config['appsecret'], 'code='.$code];
        $wx_url = preg_replace($patterns,  $fills, $api_url);
        $output = $this->curlGet($wx_url);
        return $output;
    }

    /**
     * 通过refresh_token刷新access_token
     * @param $refresh_token
     * @return mixed
     */
    public function refreshToken($refresh_token) {
        $api_url = WechatApi::API_HOST . WechatApi::REFRESH_TOKEN;
        $patterns = ['/appid=@/', '/refresh_token=@/'];
        $fills = ['appid='.$this->config['appID'], 'refresh_token='.$refresh_token];
        $wx_url = preg_replace($patterns,  $fills, $api_url);
        $output = $this->curlGet($wx_url);
        return $output;
    }

    /**
     * 拉取用户信息
     * @param $open_id
     * @param $access_token
     * @return mixed
     */
    public function getUserInfo($open_id, $access_token) {
        $api_url = WechatApi::API_HOST . WechatApi::ACCOUNT_USER_INFO;
        $patterns = ['/access_token=@/', '/openid=@/'];
        $fills = ['access_token='.$access_token, 'openid='.$open_id];
        $wx_url = preg_replace($patterns,  $fills, $api_url);
        $output = $this->curlGet($wx_url);
        return $output;
    }

    /**
     * access_token 检查
     * @param $open_id
     * @param $access_token
     * @return bool
     */
    public function checkAccessToken($open_id, $access_token) {
        $api_url = WechatApi::API_HOST . WechatApi::VALID_ACCESS_TOKEN;
        $patterns = ['/access_token=@/', '/openid=@/'];
        $fills = ['access_token='.$access_token, 'openid='.$open_id];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $output = $this->curlGet($wx_url);
        if(isset($output['errcode']) && $output['errcode'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * 获取自定义菜单
     * @return mixed
     */
    public function getMenu() {
        $access_token = $this->getAccessToken();
        $api_url = WechatApi::API_HOST . WechatApi::API_MENU_GET;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $out_put = $this->curlGet($wx_url);
        return $out_put;
    }

    /**
     * 自定义菜单创建
     * @param $values
     * @return bool
     */
    public function addMenu($values) {
        $api_url = WechatApi::API_HOST . WechatApi::API_MENU_CREATE;
        $access_token = $this->getAccessToken();
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='.$access_token];
        $wx_url = preg_replace($patterns,  $fills, $api_url);
        $data = $this->curlPost($wx_url, $values);
        if(isset($data['errcode']) && $data['errcode'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * 删除自定义菜单(全部)
     * @return bool
     */
    public function delMenu() {
        $access_token = $this->getAccessToken();
        $api_url = WechatApi::API_HOST . WechatApi::API_MENU_DELETE;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $data = $this->curlGet($wx_url);
        if(isset($data['errcode']) && $data['errcode'] == 0) {
            return true;
        }
        return false;
    }

    public function getTicketFromLocal($type, $scene_id) {
        $options = ['appid' => $this->config['appID'], 'type'=> $type, 'scene_id' => $scene_id];
        if($type == 1) { //永久
            $qr = QrCode::where($options)->first();
        }else {
            $qr = QrCode::where($options)
                ->where('created_at', '>', \DB::raw("from_unixtime(unix_timestamp()-expire_seconds)"))
                ->first();
        }
        if(empty($qr)) {
            return '';
        }else{
            return $qr->ticket;
        }
    }
    /**
     * 生成二维码
     * @param integer $type 0:临时 1:永久
     * @param integer $scene_id
     * @param int $expire_seconds
     * @return bool
     */
    public function createQrCode($type, $scene_id, $expire_seconds = 604800) {
        //先从本地数据库获取ticket
        $ticket = $this->getTicketFromLocal($type, $scene_id);
        if(!empty($ticket)) {
            return $ticket;
        }
        $access_token = $this->getAccessToken();
        $api_url = WechatApi::API_HOST . WechatApi::API_QR_CODE;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        if($type == 0) { //临时二维码
            $data = [
                'expire_seconds' => $expire_seconds,
                'action_name' => 'QR_SCENE',
                'action_info' => [
                    'scene' => [
                        'scene_id' => $scene_id
                    ]
                ]
            ];
        } else { //永久二维码
            $data = [
                'action_name' => 'QR_LIMIT_STR_SCENE',
                'action_info' => [
                    'scene' => [
                        'scene_id' => $scene_id
                    ]
                ]
            ];
        }
        $data = $this->curlPost($wx_url, json_encode($data));
        if(isset($data['errcode'])) { //生成二维码错误
            return $ticket;
        } else { //正确生成二维码
            $qr = new QrCode();
            $qr->type = $type;
            $qr->appid = $this->config['appID'];
            $qr->scene_id = $scene_id;
            $qr->expire_seconds = $expire_seconds;
            $qr->action_name = $type == 0 ? 'QR_SCENE' : 'QR_LIMIT_STR_SCENE';
            $qr->ticket = $data['ticket'];
            $qr->url = $data['url'];
            $qr->save();
            $ticket = $data['ticket'];
        }
        return $ticket;
    }

    /**
     * 通过ticket换取二维码
     * @param $ticket
     */
    public function getQrCode($ticket) {
        $patterns = ['/ticket=@/'];
        $fills = ['ticket='. $ticket];
        $wx_url = preg_replace($patterns, $fills, WechatApi::API_SHOW_QR_CODE);
        header('Location:'. $wx_url);
        exit;
    }
}