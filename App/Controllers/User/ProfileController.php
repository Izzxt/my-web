<?php

namespace App\Controllers\User;

use Core\View;
use App\Models\User;

class ProfileController
{
  public function index()
  {
    View::renderTemplate('User/profile.html', [
      'title' => 'Profile',
      'data' => User::getDataById(request()->user->id)
    ]);
  }
}
