<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-27
 * Time: 上午11:04
 */

namespace Modules\Wechat\Http\Controllers;


use App\Http\Controllers\Controller;
use Modules\Wechat\Http\Requests\WechatUtil;

/**
 * 菜单管理
 * Class MenuController
 * @package Modules\Wechat\Http\Controllers
 */
class MenuController extends Controller
{
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
}