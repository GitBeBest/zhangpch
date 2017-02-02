<?php namespace Modules\Home\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class AboutController extends Controller {
	
	public function index()
	{
		return view('home::about');
	}
	
}