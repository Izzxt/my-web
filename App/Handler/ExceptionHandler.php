<?php

namespace App\Handler;

use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

use Exception;

class ExceptionHandler implements IExceptionHandler
{
  public function handleError(Request $request, Exception $error): void
  {
    if ($error instanceof NotFoundHttpException) {

      $request->setRewriteUrl('/');
      return;
    }

    throw $error;
  }
}
