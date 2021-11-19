<?php

namespace App\Models;

use DB;
use PDO;

class Product
{
  private static $data = array('id', 'nama_produk', 'harga', 'gambar', 'penerangan', 'code_product', 'create_time', 'update_time');

  public static function getAllProducts($limit = 9, $data = null)
  {
    return DB::table('produk')->select($data ?? static::$data)->limit($limit)->orderBy('id', 'desc')->get();
  }

  public static function getProductByCode($code, $data = null)
  {
    return DB::table('produk')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('code_product', $code)->get();
  }
}
