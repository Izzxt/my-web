<?php

namespace App\Models;

use Core\Session;
use DB;
use PDO;

class Cart
{
  private static $data = array('id', 'customer_id', 'code_product', 'quantity', 'total_price', 'create_date', 'update_date');

  public static function getUserCartById($id, $data = null)
  {
    return DB::table('customer_cart')->select($data ?? static::$data)->where('customer_id', $id)->get();
  }

  public static function getCodeProduct($id, $code, $data = null)
  {
    return DB::table('customer_cart')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('customer_id', $id)->where('code_product', $code)->count();
  }

  public static function getTotalById($id)
  {
    return DB::table('customer_cart')->select(DB::raw('sum(total_price) AS tot'))->where('customer_id', $id)->get();
  }

  public static function getRowCountByUserId($id)
  {
    return DB::table('customer_cart')->where('customer_id', $id)->count();
  }

  public static function updateQuantity($id, $quantity)
  {
    $data = array(
      'quantity' => $quantity
    );

    $cart = DB::table('customer_cart')->where('id', $id)->update($data);

    return $cart;
  }

  public static function updateCart($id, $quantity, $jumlah_harga)
  {
    $data = array(
      'quantity' => $quantity,
      'total_price' => $jumlah_harga,
      'update_date' => time()
    );

    $cart = DB::table('customer_cart')->where('id', $id)->update($data);

    return $cart;
  }

  public static function addCart($id, $code, $price)
  {
    $data = array(
      'customer_id' => $id,
      'code_product' => $code,
      'quantity' => 1,
      'total_price' => $price,
      'create_date' => time(),
      'update_date' => time()
    );

    $id = DB::table('customer_cart')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->insert($data);

    return $id;
  }

  public static function deleteCart($id)
  {
    return DB::table('customer_cart')->where('id', $id)->delete();
  }

  public static function deleteUserCartById($id)
  {
    return DB::table('customer_cart')->where('customer_id', $id)->delete();
  }
}
