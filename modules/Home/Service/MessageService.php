<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-2-4
 * Time: 下午4:20
 */
namespace modules\Home\Service;
use Modules\Home\Entities\Message;

/**
 * 留言相关服务类
 * Class MessageService
 * @package modules\Home\Service
 */
class MessageService
{
    public function getLists() {
        $data = Message::all();
        return $data;
    }
}