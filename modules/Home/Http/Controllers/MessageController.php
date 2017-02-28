<?php namespace Modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;

class MessageController extends Controller {
	
	public function index()
	{
		return view('home::message', ['type' => '99']);
	}
	
}