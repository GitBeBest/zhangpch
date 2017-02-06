<?php namespace modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;

class ResourceController extends Controller {
	
	public function index()
	{
		return view('home::resource');
	}
	
}