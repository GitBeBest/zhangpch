<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-27
 * Time: 上午11:08
 */
namespace Modules\Wechat\Http\Requests;

class CustomApi {

    const API_HOST = 'https://api.weixin.qq.com';
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
    const API_KF_ACCOUNT_SEND_MESSAGE = '/cgi-bin/message/custom/send?access_token=@';
}