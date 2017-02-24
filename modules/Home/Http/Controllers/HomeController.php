<?php namespace modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Home\Service\ArticleService;

class HomeController extends Controller {
	
	public function index()
	{
	    $result = ArticleService::instance()->getPublishLists(1);
		return view('home::index', $result);
	}
	
}