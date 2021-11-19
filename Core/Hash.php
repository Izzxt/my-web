<?php
namespace Core;

class Hash
{
  public static function verify($password, $hash_password)
  {
    return password_verify($password, $hash_password);
  }

  public static function md5($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }
}
?>