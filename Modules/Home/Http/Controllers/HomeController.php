<?php namespace Modules\Home\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class HomeController extends Controller {
	
	public function index()
	{
		return view('home::index');
	}
	
}