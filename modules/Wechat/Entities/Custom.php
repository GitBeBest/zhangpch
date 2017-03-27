<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-3-27
 * Time: 上午11:47
 */

namespace Modules\Wechat\Entities;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Custom
 * @package Modules\Wechat\Entities
 *
 * @property integer $user_id
 * @property string $kf_account
 * @property string $kf_password
 * @property string $kf_nick
 * @property integer $kf_id
 * @property string $kf_headimg
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Custom extends Model
{
    use SoftDeletes;

    protected $table = 'zpc_custom';

    protected $fillable = ['user_id', 'kf_account', 'kf_password', 'kf_nick', 'kf_id', 'kf_headimg', ];
    protected $dates = ['deleted_at'];
}