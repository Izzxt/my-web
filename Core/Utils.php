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

  // Copy paste from https://stackoverflow.com/a/13212994/14433899
  public static function generateRandomString($length = 10)
  {
    return substr(str_shuffle(str_repeat($x = '0123456789zABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
  }
}
