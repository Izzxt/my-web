<?php

namespace App\Controllers\Cart;

use App\Models\Cart;
use App\Models\Product;
use Core\Session;
use Core\Utils;
use Core\View;

class CartController
{
  public $message;

  public function add()
  {
    $id = Session::get('id');
    $data = input()->post('code_product')->value;
    $product = Product::getProductByCode($data);

    foreach ($product as $row) {
      if (Cart::getCodeProduct($id, $data)) {
        redirect('/product');
        response()->json(['message' => 'items already exist']);
      } else {
        Cart::addCart($id, $data, $row->price);
        redirect('/product');
      }
    }
  }

  public function edit($id)
  {
    $quantity = input()->post('quantity')->value;
    $price = input()->post('price')->value;

    $total = $price * $quantity;

    json_encode($quantity);

    if (Cart::updateCart($id, $quantity, $total)) {
      return redirect('/cart');
    }
  }

  public function delete($id)
  {
    if (Cart::deleteCart($id)) {
      return redirect('/cart');
    }
  }

  public function index()
  {
    $id = Session::get('id');
    $cart = Cart::getUserCartById($id);
    foreach ($cart as $row) {
      $row->product = Product::getProductByCode($row->code_product);
    }

    $total = Cart::getTotalById($id);

    View::renderTemplate('Cart/cart.html', [
      'title' => 'Shopping Cart',
      'data' => $cart,
      'total' => $total,
    ]);
  }
}
