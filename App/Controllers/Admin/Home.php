<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\User;
use Core\View;
use stdClass;

class Home
{
  public function __construct()
  {
    $this->data = new stdClass();
  }

  public function index()
  {
    $this->data->customer_count = User::getUserTotal();
    $this->data->revenue =  Order::getRevenue();
    $this->data->sales = Order::getTotalSales();

    View::renderTemplate('Admin/home.html', [
      'title' => 'Dashboard',
      'data' => $this->data,
    ]);
  }
}
