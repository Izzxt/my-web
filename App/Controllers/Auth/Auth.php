<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Session;

class Auth
{
  public static function login(User $user)
  {
    session_regenerate_id(true);

    Session::set(['id' => $user->id, 'agent' => $_SERVER['HTTP_USER_AGENT']]);

    return $user;
  }

  public static function logout()
  {
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
      $params = session_get_cookie_params();

      setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
  }
}
