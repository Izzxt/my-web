<?php

namespace App\Middleware;

use App\Controllers\Auth\Auth;
use App\Models\User;
use Core\Session;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class AdminMiddleware implements IMiddleware
{
  public function handle(Request $request): void
  {
    if (User::hasRole($request->user->id, 1)) {
      redirect('/');
    }
  }
}
