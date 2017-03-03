<?php
namespace Modules\Wechat\Http\Requests;
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-2
 * Time: 下午1:37
 */


class WechatApi
{
    const API_HOST = 'https://api.weixin.qq.com';

    //认证服务器
    const OAUTH_HOST = 'https://open.weixin.qq.com';

    //获取access_token GET
    const API_ACCESS_TOKEN = '/cgi-bin/token?grant_type=client_credential&appid=@&secret=@';

    //获取微信服务器IP地址 GET
    const API_IP_LIST = '/cgi-bin/getcallbackip?access_token=@';

    //自定义菜单创建接口 POST http://mp.weixin.qq.com/wiki/10/0234e39a2025342c17a7d23595c6b40a.html
    const API_MENU_CREATE = '/cgi-bin/menu/create?access_token=@';

    //自定义菜单查询接口 GET
    const API_MENU_GET = '/cgi-bin/menu/get?access_token=@';

    //自定义菜单删除接口 GET 删除全部自定义菜单
    const API_MENU_DELETE = '/cgi-bin/menu/delete?access_token=@';

    //个性化菜单创建 POST
    const API_MENU_CONDITIONAL_CREATE = '/cgi-bin/menu/addconditional?access_token=@';

    //个性化菜单删除 POST
    const API_MENU_CONDITIONAL_DELETE = '/cgi-bin/menu/delconditional?access_token=@';

    //个性化菜单匹配
    const API_MENU_CONDITIONAL_MATCH = '/cgi-bin/menu/trymatch?access_token=@';

    //个性化菜单删除全部、个性化菜单查询
    //使用普通菜单删除和查询接口

    //获取公众号的菜单配置
    const API_MENU_MENU_INFO = '/cgi-bin/get_current_selfmenu_info?access_token=@';

    //添加客服帐号 POST
    const API_KF_ACCOUNT_ADD = '/customservice/kfaccount/add?access_token=@';

    //修改客服帐号 POST
    const API_KF_ACCOUNT_UPDATE = '/customservice/kfaccount/update?access_token=@';

    //删除客服帐号 GET
    const API_KF_ACCOUNT_DEL = '/customservice/kfaccount/del?access_token=@';

    //设置客服帐号头像 POST/FORM
    const API_KF_ACCOUNT_PIC = '/customservice/kfaccount/uploadheadimg?access_token=@&kf_account=@';

    //获取所有客服帐号
    const API_KF_ACCOUNT_LIST = '/cgi-bin/customservice/getkflist?access_token=@';

    //客服接口-发送消息
    const API_KF_SEND_MESSAGE = '/cgi-bin/message/custom/send?access_token=@';


    //用户同意授权，获取code
    const OAUTH_CODE = '/connect/oauth2/authorize?appid=@&redirect_uri=@&response_type=code&scope=@&state=@#wechat_redirect';

    //通过code获取access_token
    const ACCESS_TOKEN = '/sns/oauth2/access_token?appid=@&secret=@&code=@&grant_type=authorization_code';

    //refresh_token
    const REFRESH_TOKEN = '/sns/oauth2/refresh_token?appid=@&grant_type=refresh_token&refresh_token=@';

    //拉取用户信息
    const ACCOUNT_USER_INFO = '/sns/userinfo?access_token=@&openid=@&lang=zh_CN';

    //检验access_token是否有效
    const VALID_ACCESS_TOKEN = 'sns/auth?access_token=@&openid=@';
}