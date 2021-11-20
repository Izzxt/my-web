<?php

namespace App\Controllers\User;

use Core\View;
use App\Models\User;
use Core\Utils;
use Core\Hash;

class ProfileController
{
  public function updatename($id)
  {
    $name = input('name');

    if (User::updateUserName($id, $name)) {
      return redirect('/profile');
    }
  }

  public function updateemail($id)
  {
    $user = User::getDataById($id);
    $email = input('email');
    $newEmail = input('new_email');

    if ($user->email == $email) {
      if (User::updateEmail($id, $newEmail)) return redirect('/profile');
    } else {
      response()->json(['message' => 'provided current email is incorrect']);
    }
  }

  public function updatephone($id)
  {
    $user = User::getDataById($id);
    $phone = input('phone');
    $newPhone = input('new_phone');

    if ($user->phone_number == $phone) {
      if (User::updatePhone($id, $newPhone)) return redirect('/profile');
    } else {
      response()->json(['message' => 'provided current phone is incorrect']);
    }
  }

  public function updatepassword($id)
  {
    $user = User::getDataById($id);
    $curPassword = input('current_password');
    $newPassword = input('new_password');
    $conPassword = input('confirm_password');
    $verifyPassword = Hash::verify($curPassword, $user->password);
    $hashedPassword = Hash::md5($newPassword);

    if ($newPassword != $conPassword) {
      return response()->json(['message' => 'provided new password is not match with confirm password']);
    }

    if ($verifyPassword == $curPassword) {
      if (User::updatePassword($id, $hashedPassword)) return redirect('/profile/user/password');
    } else {
      response()->json(['message' => 'provided current password is incorrect']);
    }
  }

  public function index()
  {
    $user = User::getDataById(request()->user->id);
    $email = Utils::hideEmail($user->email);
    $phone = Utils::hidePhoneNumber($user->phone_number);
    View::renderTemplate('User/profile.html', [
      'title' => 'Profile',
      'data' => $user,
      'email' => $email,
      'phone' => $phone
    ]);
  }

  public function indexPassword()
  {
    View::renderTemplate('User/password.html', [
      'title' => 'Password',
      'data' => User::getDataById(request()->user->id)
    ]);
  }
}
