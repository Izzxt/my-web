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

  public static function insertOrder($id, $code, $orderNumber, $qty, $totalPrice, $shippingAddress)
  {
    $data = array(
      'customer_id' => $id,
      'order_number' => $orderNumber,
      'code_product' => $code,
      'shipping_address' => $shippingAddress,
      'quantity' => $qty,
      'total_price' => $totalPrice,
      'timestamp' => time()
    );

    $id = DB::table('order_details')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->insert($data);

    return $id;
  }

  public static function getRevenue()
  {
    return DB::table('order_details')->select(DB::raw('SUM(total_price) as revenue'))->where('payment_status', '=', 'paid')->get();
  }

  public static function getTotalSales()
  {
    return DB::table('order_details')->where('payment_status', '=', 'paid')->count();
  }

}