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

    //获取自定义菜单配置接口
    const API_MENU_GET_CURRENT_SELF = '/cgi-bin/get_current_selfmenu_info?access_token=@';

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

    /*************************************素材管理*******************************/
    //新增临时素材
    const API_UPLOAD_MEDIA = '/cgi-bin/media/upload?access_token=@&type=@';

    //获取临时素材
    const API_GET_MEDIA = '/cgi-bin/media/get?access_token=@&media_id=@';

    //新增永久素材
    const API_ADD_MATERIAL = '/cgi-bin/material/add_news?access_token=ACCESS_TOKEN';
    //获取永久素材
    const API_GET_MATERIAL = '/cgi-bin/material/get_material?access_token=ACCESS_TOKEN';
    //删除永久素材
    const API_DEL_MATERIAL = '/cgi-bin/material/del_material?access_token=ACCESS_TOKEN';
    //修改永久图文素材
    const API_UPDATE_MATERIAL = '/cgi-bin/material/update_news?access_token=ACCESS_TOKEN';
    //获取素材总数
    const API_GET_MATERIAL_COUNT = '/cgi-bin/material/get_materialcount?access_token=ACCESS_TOKEN';
    //获取素材列表
    const API_GET_MATERIAL_BATCH = '/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN';

    /*************************************用户管理**************************************/
    //用户分组管理
    /**
     * 创建分组 POST
     * {"group":{"name":"test"}}
     * {"group": {"id": 107,"name": "test"}}
     *{"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_CREATE = '/cgi-bin/groups/create?access_token=@';
    /**
     * 查询所有分组 GET
     *
     * {"groups": [{"id": 0,"name": "未分组","count": 72596},{"id": 1,"name": "黑名单","count": 36}]}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_GET = '/cgi-bin/groups/get?access_token=@';

    /**
     * 查询用户所在分组 POST
     * {"openid":"od8XIjsmk6QdVTETa9jLtGWA6KBc"}
     * {"groupid": 102}
     * {"errcode":40003,"errmsg":"invalid openid"}
     */
    const API_GROUP_GET_ID = '/cgi-bin/groups/getid?access_token=@';

    /**
     * 修改分组名 POST
     * {"group":{"id":108,"name":"test2_modify2"}}
     * {"errcode": 0, "errmsg": "ok"}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_UPDATE = '/cgi-bin/groups/update?access_token=@';
    /**
     * 移动用户分组 POST
     * {"openid":"oDF3iYx0ro3_7jD4HFRDfrjdCM58","to_groupid":108}
     * {"errcode": 0, "errmsg": "ok"}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_MEMBER_UPDATE = '/cgi-bin/groups/members/update?access_token=@';
    /*
     * 批量移动用户分组 POST
     * {"openid_list":["oDF3iYx0ro3_7jD4HFRDfrjdCM58","oDF3iY9FGSSRHom3B-0w5j4jlEyY"],"to_groupid":108}
     * {"errcode": 0, "errmsg": "ok"}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_MEMBER_BATCH_UPDATE = '/cgi-bin/groups/members/batchupdate?access_token=@';
    /**
     * 删除分组 POST
     * {"group":{"id":108}}
     * {"errcode": 0, "errmsg": "ok"}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_GROUP_DELETE = '/cgi-bin/groups/delete?access_token=@';

    /**
     * 设置用户备注名
     * {"openid":"oDF3iY9ffA-hqb2vVvbr7qxf6A0Q","remark":"pangzi"}
     * {"errcode":0,"errmsg":"ok"}
     * {"errcode":40013,"errmsg":"invalid appid"}
     */
    const API_USER_REMARK_UPDATE = '/cgi-bin/user/info/updateremark?access_token=@';

    /**
     * 获取用户基本信息(UnionID机制) GET
     */
    const API_USER_INFO = '/cgi-bin/user/info?access_token=@&openid=@&lang=zh_CN';

    /**
     * 批量获取用户基本信息 POST
     * {"user_list": [{"openid": "otvxTs4dckWG7imySrJd6jSi0CWE","lang": "zh-CN"},{"openid": "otvxTs_JZ6SEiP0imdhpi50fuSZg","lang": "zh-CN"}]}
     */
    const API_USER_INFO_BATCH = '/cgi-bin/user/info/batchget?access_token=@';

    /**
     * 获取用户列表
     * {"total":2,"count":2,"data":{"openid":["","OPENID1","OPENID2"]},"next_openid":"NEXT_OPENID"}
     */
    const API_USER_LIST = '/cgi-bin/user/get?access_token=@&next_openid=@';

    /**
     * 获取用户地理位置
     * 推送消息
     */

    /*************************************帐号管理**************************************/
    //生成带参数的二维码
    const API_QR_CODE = '/cgi-bin/qrcode/create?access_token=@';
    //通过ticket换取二维码,提醒：TICKET记得进行UrlEncode
    const API_SHOW_QR_CODE = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=@';
    //长链接转短链接接口
    const API_SHORT_URL = '/cgi-bin/shorturl?access_token=@';
    //微信认证事件推送

}