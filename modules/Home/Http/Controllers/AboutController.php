<?php namespace Modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;

class AboutController extends Controller {
	
	public function index()
	{
		return view('home::about', ['type' => 100]);
	}
	
}