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

class AccessToken extends Model
{
    use SoftDeletes;

    protected $table = 'zpc_wx_access_token';

    protected $fillable = ['dev_id', 'openid', 'access_token', 'expires_in'];
    protected $dates = ['deleted_at'];
}