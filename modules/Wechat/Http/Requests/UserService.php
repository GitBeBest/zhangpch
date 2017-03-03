<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-2
 * Time: 下午6:37
 */

namespace Modules\Wechat\Http\Requests;


use Modules\Home\Entities\User;
use Modules\Wechat\Entities\OauthToken;

class UserService
{
    /**
     * 通过微信返回的用户信息获取用户
     * @param $user_ifo
     * @return User
     */
    public function getUserByUserInfo($user_ifo) {
        $user = User::where('openid', $user_ifo['openid'])->first();
        if(empty($user)) {
            $user = new User();
            $fill_attr = $user->getFillable();
            foreach ($fill_attr as $attr) {
                if (isset($user_ifo[$attr])) {
                    $user->{$attr} = $user_ifo[$attr];
                }
            }
            $user->save();
        }

        return $user;
    }

    /**
     * 根据open_id获取用户信息
     * @param $open_id
     * @return mixed
     */
    public function getUserByOpenId($open_id) {
        $user = User::where('openid', $open_id)->first();
        return $user;
    }

    public function saveAuthToken($values){
        $token_entity = new OauthToken();
        $fill_attr = $token_entity->getFillable();
        foreach ($fill_attr as $attr) {
            if (isset($values[$attr])) {
                $token_entity->{$attr} = $values[$attr];
            }
        }

        $token_entity->save();
    }
}