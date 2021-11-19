<?php

namespace App\Controllers\Home;

use App\Models\User;
use Core\Session;
use Core\View;

class home
{
    public function index()
    {
        
        $data = User::getDataById(Session::get('id'));

        View::renderTemplate('Home/home.html', [
            'title' => 'Home',
            'users' => $data
        ]);
    }

    public function test()
    {
        response()->json(["message" => "logged in", "logout" => "/logout", "home" => "/home"]);
    }
}
