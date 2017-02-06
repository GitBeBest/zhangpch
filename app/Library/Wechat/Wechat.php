<?php

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2016/7/1
 * Time: 0:05
 */
namespace App\Library\Wechat;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Mockery\Exception;

class Wechat
{
    private $config;
    private $appId;
    private $appSecret;
    private $access_token;

    public function __construct()
    {
        $this->config = \Config::get('wechat');
        if(!isset($this->config['appID'])) {
            throw new Exception('APPID is not set');
        }
        if(!isset($this->config['appSecret'])) {
            throw new Exception('APPID is not set');
        }
        
        $this->appId = $this->config['appID'];
        $this->appSecret = $this->config['appSecret'];
    }

    /**
     * 获取access token
     * @return mixed
     */
    public function getAccessToken()
    {
        $redis = Redis::connect();
        $access_token = $redis->get('wechat_access_token');
        if(empty($access_token)) {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->appId.'&secret='.$this->appSecret;
            $response = Request::create($url, 'GET');
            if(isset($response['access_token'])) {
                $redis->setex('wechat_access_token', 5400, $response['access_token']);
                $this->access_token = $response['access_token'];
                return $response['access_token'];
            } else {
                throw new Exception($response['message']);
            }
        } else {
            $this->access_token = $access_token;
            return $access_token;
        }
    }

    /**
     * 获取微信服务器IP地址
     * @return mixed
     */
    public function getHostIP()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token='.$this->access_token;

        $response = Request::create($url, 'GET');
        if(isset($response['ip_list'])) {
            return $response['ip_list'];
        } else {
            throw new Exception($response['message']);
        }
    }
}