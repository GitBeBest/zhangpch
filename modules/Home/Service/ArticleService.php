<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-2-4
 * Time: 下午4:20
 */
namespace modules\Home\Service;
use Modules\Home\Entities\Article;

/**
 * 文章相关服务类
 * Class ArticleService
 * @package modules\Home\Service
 */
class ArticleService
{
    private static $_instance;
    public static function instance() {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getPublishLists($page) {
        $count = Article::where('status', 1)->count();
        $data = Article::where('status', 1)->skip($page-1)->take(15)->get();
        return [ 'total' => $count, 'article' => $data];
    }

    public function getStoreLists() {
        $data = Article::where('status', 0)->get();
        return $data;
    }

    public function getRubbishLists() {
        $data = Article::onlyTrashed()->get();
        return $data;
    }
}