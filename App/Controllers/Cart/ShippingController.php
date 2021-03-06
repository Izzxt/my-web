<?php

namespace App\Controllers\Cart;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Core\Session;
use Core\View;

class ShippingController
{
  public function details($orderNumber)
  {
    $data = Order::getDataByOrderNumber($orderNumber);

    View::renderTemplate('Cart/order.html', [
      'title' => 'Order Details',
      'data' => $data
    ]);
  }

  public function index()
  {
    $id = Session::get('id');
    $cart = Cart::getUserCartById($id);
    foreach ($cart as $row) {
      $row->product = Product::getProductByCode($row->code_product);
    }

    View::renderTemplate('Cart/shipping.html', [
      'title' => 'Shipping',
      'data' => $cart,
      'total' => Cart::getTotalById($id),
    ]);
  }
}
