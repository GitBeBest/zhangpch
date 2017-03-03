<?php namespace Modules\Home\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model {
    use SoftDeletes;

    protected $table = 'zpc_user';
    protected $fillable = ['username', 'nickname', 'password', 'headimgurl', 'email', 'openid', 'sex', 'country','province', 'language', 'address', 'telephone'];

    protected $dates = ['deleted_at'];

}