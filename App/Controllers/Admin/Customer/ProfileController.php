<?php

namespace App\Controllers\Admin\Customer;

use App\Models\Order;
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
            return redirect('/admin/customer/account');
        }

    }

    public function delete($id)
    {
        if (User::deleteUserById($id)) {
            return redirect('/admin/customer/account');
        }
    }

    public function incomingorder() {

        $view = input()->post('view');

        if (isset($view)) {
            if ($view != '') {
                Order::updateAllUnseenOrders();
            }
        }
        $orderCount = Order::getAllUnseenOrders();

        if ($orderCount > 0) {
            response()->json([$orderCount]);
        } else {
            response()->json([0]);
        }
    }
}
