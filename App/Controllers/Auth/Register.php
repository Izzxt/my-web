<?php

namespace App\Controllers\Auth;

use App\Models\User;
use Core\Validation;
use Core\View;

class Register
{
  public function request()
  {
    $username = input('username');
    $playerData = (object)input()->all();

    $dataValid =  [
      'username'         => 'required|min:3|max:20',
      'name'             => 'required|min:3|max:20',
      'phone_number'     => 'required|min:3|max:20',
      'email'            => 'required|max:150|email',
      'password'         => 'required|min:6|max:20',
      'confirm_password' => 'required|min:6|max:20|same:password',
    ];

    Validation::validate($dataValid);

    // check if username already exist
    if (User::getDataByUsername($username)) {
      response()->json(["status" => "error", "message" => "username already exists"]);
    }

    // check if email already exists
    if (User::getDataByEmail(input()->post('email')->value)) {
      response()->json(["status" => "error", "message" => "email already exists"]);
    }

    // throw error if something went wrong with the registration
    if (!User::create($playerData)) {
      response()->json(["status" => "error", "message" => "something went wrong"]);
      // echo json_encode(["status" => "error", "message" => "something went wrong"]);
    }

    $user = User::getDataByUsername($username, array('id', 'password'));

    Auth::login($user);
    redirect('/');
  }

}
