<?php namespace Modules\Home\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model {
    use SoftDeletes;

    protected $table = 'zpc_article';

    protected $fillable = ['title', 'resume', 'content', 'category', 'view_times', 'praise_times', 'hate_times', 'link_img', 'status'];
    protected $dates = ['deleted_at'];
}