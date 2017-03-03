<?php
namespace Modules\Wechat\Entities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-3
 * Time: 上午11:30
 */
class OauthToken extends Model
{
    use SoftDeletes;

    protected $table = 'zpc_auth_token';

    protected $fillable = ['user_id', 'openid', 'access_token', 'expires_in', 'refresh_token', 'scope'];
    protected $dates = ['deleted_at'];
}