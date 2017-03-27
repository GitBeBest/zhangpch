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
 * Class AccessToken
 * @package Modules\Wechat\Entities
 *
 * @property string $dev_id
 * @property string $openid
 * @property string $access_token
 * @property integer $expires_in
 * @property string $jsapi_ticket
 */
class AccessToken extends Model
{
    use SoftDeletes;

    protected $table = 'zpc_wx_access_token';

    protected $fillable = ['dev_id', 'openid', 'access_token', 'expires_in', 'jsapi_ticket'];
    protected $dates = ['deleted_at'];
}