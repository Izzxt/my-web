<?php

namespace App\Controllers\Product;

use Core\View;
use App\Models\Product;

class ProductController
{
  public function index()
  {
    View::renderTemplate('Product/our-drink.html', [
      'title' => 'Our Drink',
      'item' => Product::getAllProducts()
    ]);
  }
}
