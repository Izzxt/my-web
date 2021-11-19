<?php

namespace Core;

class Utils
{
  public static function Logger($consoleLogger)
  {
    echo '<script>console.log(' . json_encode($consoleLogger) . ')</script>';
  }

  public static function ErrorMessage($message)
  {
    return Session::set(['error' => $message]);
  }
}
