<?php

namespace App\Controllers\Cart;

use App\Models\Order;
use Core\Utils;
use Core\View;

class OrderController
{
  public function order()
  {
    # code...
  }

  public function details($orderNumber)
  {
    $data = Order::getDataByOrderNumber($orderNumber);

    View::renderTemplate('Cart/order.html', [
      'title' => 'Order Details',
      'data' => $data,
      'number' => Utils::generateRandomString(6)
    ]);
  }
}
