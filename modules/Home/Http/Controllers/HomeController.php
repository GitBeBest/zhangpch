<?php namespace modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Home\Service\ArticleService;

class HomeController extends Controller {
	
	public function index($page = 1)
	{
	    $result = ArticleService::instance()->getPublishLists($page);
		return view('home::index', ['article' => $result]);
	}
	
}