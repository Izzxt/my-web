<?php

namespace App\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class LoggedInMiddleware implements IMiddleware
{
  public function handle(Request $request): void
  {
    if (!isset($request->user)) {
      redirect('/');
    }
    return;
  }
}
