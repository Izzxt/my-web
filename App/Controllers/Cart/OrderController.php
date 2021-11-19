<?php

namespace App\Controllers\Cart;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Core\Utils;
use Core\View;

class OrderController
{
  public function order()
  {
    $id = request()->user->id;
    $data = Cart::getUserCartById($id);
    $orderNumber = Utils::generateRandomString(6);

    foreach ($data as $value) {
      $_code[] = $value->code_product;
      $_qty[] = $value->quantity;
      $totalPrice = Cart::getTotalById($id);
    }

    $qty = implode(',', $_qty);
    $code = implode(',', $_code);

    if (Order::insertOrder($id, $code, $orderNumber, $qty, $totalPrice[0]->total, '')) {
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
