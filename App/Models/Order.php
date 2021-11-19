<?php

namespace App\Models;

use DB;
use PDO;

class Order
{
  private static $data = array('id', 'customer_id',  'order_number', 'code_product', 'shipping_address',  'quantity', 'total_price', 'payment_status', 'status', 'timestamp');

  public static function getDataById($id, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->where('costomer_id', $id)->get();
  }

  public static function getDataByOrderNumber($orderNumber, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('order_number', $orderNumber)->get();
  }
}
