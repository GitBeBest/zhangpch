<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2016/6/30
 * Time: 22:01
 */

namespace Modules\Wechat\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function login()
    {
        return view('wechat::wechat.login');
    }

    public function index()
    {
        $input = Input::get();
        print $input;
        $username = Input::get('username');
        $password = Input::get('password');

    }
}