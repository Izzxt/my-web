<?php

namespace Core;

use App\Models\User;

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

  /**
   * Reference Link
   * @link {https://stackoverflow.com/a/13212994/14433899}
   */
  public static function generateRandomString($length = 10)
  {
    return date('yhis') . substr(str_shuffle(str_repeat($x = '0123456789zABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
  }

  /**
   * Reference Link
   * @link {https://www.cluemediator.com/partially-hide-email-address-in-php}
   */
  public static function hideEmail($email)
  {
    // use FILTER_VALIDATE_EMAIL filter to validate an email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      // split an email by "@"
      list($first, $last) = explode("@", $email);

      // get half the length of the first part
      $len = floor(strlen($first) / 2);

      // partially hide a string by "*" and return full string
      return substr($first, 0, $len) . str_repeat('*', $len) . "@" . $last;
    }
  }

  public static function hidePhoneNumber($phone)
  {
    return substr($phone, 0, 2) . '******' . substr($phone, -2);
  }
}
