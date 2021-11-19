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
    $data = input()->post('code_product')->value;
    $product = Product::getProductByCode($data);

    foreach ($product as $row) {
      if (Cart::getCodeProduct($data)) {
        // $this->message = Utils::ErrorMessage('items already exist', '/product');
        // Utils::Logger($this->message);
        redirect('/product');
        response()->json(['message' => 'items already exist']);
      }
      if (Cart::addCart($data, $row->harga)) {
        // Utils::ErrorMessage('Added to cart.');
        redirect('/product');
        Session::set(['message' => 'Added to cart.']);
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
    $cart = Cart::getUserCartById(Session::get('id'));
    foreach ($cart as $row) {
      $row->product = Product::getProductByCode($row->code_product);
    }

    View::renderTemplate('Cart/cart.html', [
      'title' => 'Shopping Cart',
      'data' => $cart,
      'total' => Cart::getTotalById(request()->user->id),
    ]);
  }
}
