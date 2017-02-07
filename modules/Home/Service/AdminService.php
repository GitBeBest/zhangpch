<?php
/**
 * Created by PhpStorm.
 * User: zpc
 * Date: 17-2-7
 * Time: 下午2:38
 */

namespace Modules\Home\Service;


class AdminService
{
    private static $_instance;
    public static function instance() {
        if(!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getData($index) {
        $data = [];
        if($index == 1){
            $data = ArticleService::instance()->getPublishLists();
        }elseif ($index == 2){
            $data = ArticleService::instance()->getStoreLists();
        }elseif($index == 3) {
            $data = ArticleService::instance()->getRubbishLists();
        }elseif ($index == 5){
            $data = [];
        }

        return $data;
    }
}