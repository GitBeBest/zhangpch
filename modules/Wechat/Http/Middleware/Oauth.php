<?php

namespace Modules\Wechat\Http\Middleware;

use Closure;
use Modules\Wechat\Http\Requests\UserService;
use Modules\Wechat\Http\Requests\WechatUtil;

class Oauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $open_id = session('wx.program.openid');
        if(empty($open_id)) {
            $util = new WechatUtil();
            if(empty($request->input('code'))) {
                $util->getOauthCode(urlencode($request->getSchemeAndHttpHost(). $request->getRequestUri()), 'snsapi_userinfo');
            } else{
                $result = $util->getOpenId($request->input('code'));
                //根据code，如果能够获取到openid
                if(isset($result['openid'])) {
                    $user_service = new UserService();
                    $user = $user_service->getUserByOpenId($result['openid']);
                    if(empty($user->nickname)){
                        $user_info = $util->getUserInfo($result['openid'], $result['access_token']);
                        $user_service->saveUserInfo($user_info);
                    }
                    $result['user_id'] = $user->id;
                    $user_service->saveAuthToken($result);
                    session(['wx.program.openid' => $result['openid']]);
                }else{
                    return redirect()->to($this->getTargetUrl($request));
                }
            }
        }
        return $next($request);
    }

    /**
     * 获取真实除code、state之外url
     * @param $request
     * @return string
     */
    protected function getTargetUrl($request)
    {
        $queries = array_except($request->query(), ['code', 'state']);

        return $request->url().(empty($queries) ? '' : '?'.http_build_query($queries));
    }
}
