<?php

namespace App\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
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
    $order = Order::getAllOrderDetails();

    foreach ($order as $value) {
      $value->details = Order::getDataByOrderNumber($value->order_number);

      foreach ($value->details as $detail) {
        $value->customer = User::getDataById($detail->customer_id);
        $value->cart = json_decode($detail->cart);

        foreach ($value->cart as $data) {
          $data->product[] = Product::getProductByCode($data->code);
        }
      }
    }

    View::renderTemplate('Admin/home.html', [
      'title' => 'Dashboard',
      'data' => $this->data,
      'cart' => $order,
    ]);
  }
}
