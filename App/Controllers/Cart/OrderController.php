<?php

namespace App\Controllers\Cart;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Core\Utils;
use Core\View;
use stdClass;

class OrderController
{
  public function __construct()
  {
    $this->data = new stdClass();
  }

  public function order()
  {
    $id = request()->user->id;
    $data = Cart::getUserCartById($id);
    $orderNumber = Utils::generateRandomString(6);
    $array = [];

    foreach ($data as $value) {
      $totalPrice = Cart::getTotalById($id);

      array_push(
        $array,
        [
          'customer_id' => $value->customer_id,
          'code' => $value->code_product,
          'quantity' => $value->quantity,
          'price' => $value->total_price
        ]
      );

      $cart = json_encode($array);
    }

    if (Order::insertOrder($id,  $orderNumber, $totalPrice[0]->tot, '', $cart)) {
      Cart::deleteUserCartById($id);
      redirect('/order/' . $orderNumber);
    }
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
