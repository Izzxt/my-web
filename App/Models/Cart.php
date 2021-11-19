<?php

namespace App\Models;

use Core\Session;
use DB;
use PDO;

class Cart
{
  private static $data = array('id', 'id_pelanggan', 'code_product', 'kuantiti', 'jumlah_harga', 'create_time', 'update_time');

  public static function getUserCartById($id, $data = null)
  {
    return DB::table('cart_pelanggan')->select($data ?? static::$data)->where('id_pelanggan', $id)->get();
  }

  public static function getCodeProduct($code, $data = null)
  {
    return DB::table('cart_pelanggan')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('code_product', $code)->first();
  }

  public static function getTotalById($id)
  {
    return DB::query('SELECT SUM(jumlah_harga) AS total FROM cart_pelanggan')->where('id_pelanggan', $id)->get();
  }

  public static function getRowCountByUserId($id)
  {
    return DB::table('cart_pelanggan')->where('id_pelanggan', $id)->count();
  }

  public static function updateQuantity($id, $quantity)
  {
    $data = array(
      'kuantiti' => $quantity
    );

    $cart = DB::table('cart_pelanggan')->where('id', $id)->update($data);

    return $cart;
  }

  public static function updateCart($id, $kuantiti, $jumlah_harga)
  {
    $data = array(
      'kuantiti' => $kuantiti,
      'jumlah_harga' => $jumlah_harga,
      'update_time' => date('Y-m-d H:i:s')
    );

    $cart = DB::table('cart_pelanggan')->where('id', $id)->update($data);

    return $cart;
  }

  public static function addCart($code, $price)
  {
    $data = array(
      'id_pelanggan' => Session::get('id'),
      'code_product' => $code,
      'kuantiti' => 1,
      'jumlah_harga' => $price,
      'create_time' => date('Y-m-d H:i:s'),
      'update_time' => date('Y-m-d H:i:s')
    );

    $id = DB::table('cart_pelanggan')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->insert($data);

    return $id;
  }

  public static function deleteCart($id)
  {
    return DB::table('cart_pelanggan')->where('id', $id)->delete();
  }
}
