<?php

namespace App\Models;

use DB;
use PDO;

class Order
{
  private static $data = array('id', 'id_pelanggan',  'order_number', 'quantity', 'total_price', 'payment_status', 'status', 'code_product', 'timestamp');

  public static function getDataById($id, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->where('id_pelanggan', $id)->get();
  }

  public static function getDataByOrderNumber($orderNumber, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('order_number', $orderNumber)->get();
  }
}
