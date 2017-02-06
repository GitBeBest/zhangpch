<?php namespace modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
	
	public function index()
	{
		return view('home::index');
	}
	
}