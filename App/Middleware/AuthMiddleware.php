<?php

namespace App\Middleware;

use App\Controllers\Auth\Auth;
use App\Models\User;
use Core\Session;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AuthMiddleware implements IMiddleware
{
  public function handle(Request $request): void
  {
    $request->user = User::getDataById(Session::get('id'));
    if ($request->user == null) {
      return;
    }

    if ($_SERVER['HTTP_USER_AGENT'] != Session::get('agent')) {
      Auth::logout();
      redirect('/');
    }
  }
}
