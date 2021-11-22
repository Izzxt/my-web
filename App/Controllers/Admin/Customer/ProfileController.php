<?php

namespace App\Controllers\Admin\Customer;

use App\Models\User;
use Core\View;

class ProfileController
{

    public function index()
    {
        View::renderTemplate('Admin/Customer/profile.html', [
            'title' => 'Customer Profile',
            'data' => User::getAllUsers()
        ]);
    }

    public function update($id)
    {

        $name = input('name');
        $email = input('email');
        $phone = input('phone_number');

        if( User::updateUser($id, $name, $email, $phone)) {
            return redirect('/admin/customer/profile');
        }

    }

    public function delete($id)
    {
        if (User::deleteUserById($id)) {
            return redirect('/admin/customer/profile');
        }
    }
}
