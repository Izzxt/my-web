<?php

namespace App\Controllers\Auth;

use Core\Hash;
use App\Models\User;

class Login
{
   public function logout()
   {
      Auth::logout();
      redirect('/');
   }

   public function request()
   {
      $player = User::getDataByEmail(input('email'), array('id', 'email', 'kata_laluan'));
      if ($player == null || !Hash::verify(input('password'), $player->kata_laluan))
      {
          response()->json(["status" => "error", "message" => "invalid password"]);
      }

      $this->login($player);
   } 

   protected function login(User $user)
   {
       if ($user && Auth::login($user)) {
         //  response()->json(["status" => "success", "location" => "/"]);
          redirect('/');
       } else {
          return response()->json(["status" => "error", "location" => "invalid password"]);
       }
   }
}
?>