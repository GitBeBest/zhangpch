<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-27
 * Time: 上午11:10
 */

namespace Modules\Wechat\Http\Requests;


use Modules\Home\Entities\User;
use Modules\Wechat\Entities\Custom;

class CustomUtil
{
    /**
     * 添加客服帐号
     * @param integer $user_id 用户id
     * @param string $nickname 客服昵称
     * @param string $password 客服密码
     * @return bool
     */
    public function addCustom($user_id, $nickname, $password){
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_ADD;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);

        $user = User::find($user_id);
        if ($user) {
            $data = [
                "kf_account" => $user->openid,
                "nickname" => $nickname,
                "password" => $password
            ];
            $out_put = $util->curlPost($wx_url, json_encode($data, true));
            if (isset($out_put['errcode']) && $out_put['errcode'] == 0) {
                //保存到本地
                $custom = new Custom();
                $custom->user_id = $user_id;
                $custom->kf_account = $user->openid;
                $custom->kf_password = $password;
                $custom->kf_nick = $nickname;
                $custom->save();
                return true;
            }
        }
        return false;
    }

    /**
     * 修改客服帐号
     * @param integer $custom_id
     * @param string $nickname
     * @param string $password
     * @method POST
     * @return bool
     */
    public function updateCustom($custom_id, $nickname, $password) {
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_UPDATE;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);

        $custom = Custom::find($custom_id);
        if ($custom) {
            $data = [
                "kf_account" => $custom->kf_account,
                "nickname" => $nickname,
                "password" => $password
            ];
            $out_put = $util->curlPost($wx_url, json_encode($data));
            if (isset($out_put['errcode']) && $out_put['errcode'] == 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * 删除客服帐号
     * @param $data
     * @method POST
     * @return bool
     */
    public function delCustom($data){
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_DEL;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $out_put = $util->curlPost($wx_url, $data);
        if (isset($out_put['errcode']) && $out_put['errcode'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * 设置客服帐号的头像
     * @param $kf_account
     * @param $file_path
     * @return bool
     */
    public function setCustomHead($kf_account, $file_path) {
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_PIC;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $out_put = $util->curlUpload($wx_url, $file_path);
        if (isset($out_put['errcode']) && $out_put['errcode'] == 0) {
            return true;
        }
        return false;
    }

    /**
     * 获取客服列表
     * @return mixed
     */
    public function getCustomList() {
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_LIST;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $out_put = $util->curlGet($wx_url);
        return $out_put;
    }

    /**
     * 客服发消息
     * @param $data
     * @return mixed
     */
    public function sendMessage($data) {
        $util = new WechatUtil();
        $access_token = $util->getAccessToken();
        $api_url = CustomApi::API_HOST . CustomApi::API_KF_ACCOUNT_SEND_MESSAGE;
        $patterns = ['/access_token=@/'];
        $fills = ['access_token='. $access_token];
        $wx_url = preg_replace($patterns, $fills, $api_url);
        $out_put = $util->curlPost($wx_url, $data);
        return $out_put;
    }
}