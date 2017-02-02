<?php namespace Modules\Home\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ResourceController extends Controller {
	
	public function index()
	{
		return view('home::resource');
	}
	
}