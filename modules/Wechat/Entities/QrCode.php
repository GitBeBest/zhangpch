<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-7
 * Time: 上午10:52
 */

namespace Modules\Wechat\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QrCode
 * @package Modules\Wechat\Entities
 *
 * @property string $appid
 * @property integer $scene_id
 * @property integer $expire_seconds
 * @property string $action_name
 * @property string $scene_str
 * @property string $ticket
 * @property string $url
 */
class QrCode extends Model
{
    use SoftDeletes;

    protected $table = 'zpc_qr_code';

    protected $fillable = ['appid', 'scene_id', 'expire_seconds', 'action_name', 'scene_str', 'ticket', 'url'];
    protected $dates = ['deleted_at'];
}