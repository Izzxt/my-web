<?php

namespace App\Models;

use DB;
use PDO;

class Order
{
  private static $data = array('id', 'customer_id',  'order_number', 'shipping_address', 'total_price', 'payment_status', 'status', 'timestamp', 'cart', 'notif_status');

  public static function getAllOrderDetails($limit = 10)
  {
    return DB::table('order_details')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->orderBy('id', 'desc')->limit($limit)->get();
  }

  public static function getAllUnseenOrders()
  {
    return DB::table('order_details')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('notif_status', '=', 1)->count();
  }

  public static function updateAllUnseenOrders()
  {
    $data = array(
      'notif_status' => 0
    );
    return DB::table('order_details')->where('notif_status', '=', 1)->update($data);
  }

  public static function getDataById($id, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->where('customer_id', $id)->get();
  }

  public static function getDataByOrderNumber($orderNumber, $limit = 10, $data = null)
  {
    return DB::table('order_details')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('order_number', $orderNumber)->limit($limit)->get();
  }

  public static function insertOrder($id, $orderNumber, $totalPrice, $shippingAddress, $cart)
  {
    $data = array(
      'customer_id' => $id,
      'order_number' => $orderNumber,
      'shipping_address' => $shippingAddress,
      'total_price' => $totalPrice,
      'timestamp' => time(),
      'cart' => $cart
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
