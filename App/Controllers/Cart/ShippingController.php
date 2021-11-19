<?php
namespace App\Controllers\Cart;

use App\Models\Cart;
use App\Models\Product;
use Core\Session;
use Core\View;

class ShippingController 
{
  public function index()
  {
    $cart = Cart::getUserCartById(Session::get('id'));
    foreach ($cart as $row) {
      $row->product = Product::getProductByCode($row->code_product);
    }

    View::renderTemplate('Cart/shipping.html', [
      'title' => 'Shipping',
      'data' => $cart,
      'total' => Cart::getTotalById(request()->user->id),
    ]);
  }
}
