<?php
namespace Modules\Wechat\Http\Requests;
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
     * 获取code
     * @param $redirect_url
     * @param string $scope
     * @param int $state
     */
    public function getOauthCode($redirect_url, $scope = 'snsapi_base', $state=0) {
        $api_url = WechatApi::OAUTH_HOST . WechatApi::OAUTH_CODE;
        $patterns = ['/appid=@/', '/redirect_uri=@/', '/scope=@/', '/state=@/'];
        $fills = ['appid='.$this->config['appID'], 'redirect_uri='.$redirect_url, 'scope='.$scope, 'state='.$state];
        $out = preg_replace($patterns, $fills,  $api_url);
        header('Location:'. $out);
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

}