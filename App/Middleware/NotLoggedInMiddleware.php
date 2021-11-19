<?php

namespace App\Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class NotLoggedInMiddleware implements IMiddleware
{
  public function handle(Request $request): void
  {
    if (is_null($request->user)) {
      redirect('/');
    }
    return;
  }
}
