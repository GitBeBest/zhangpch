<?php namespace Modules\Home\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PhotoController extends Controller {
	
	public function index()
	{
		return view('home::photo');
	}
	
}