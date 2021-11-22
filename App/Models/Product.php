<?php

namespace App\Models;

use DB;
use PDO;

class Product
{
  private static $data = array('id', 'product_name', 'code_product', 'price', 'images', 'images', 'description', 'create_date', 'update_date');

  public static function getAllProducts($limit = 9, $data = null)
  {
    return DB::table('product')->select($data ?? static::$data)->limit($limit)->orderBy('id', 'desc')->get();
  }

  public static function getProductByCode($code, $limit = 10, $data = null)
  {
    return DB::table('product')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('code_product', $code)->limit($limit)->get();
  }
}
