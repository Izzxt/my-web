<?php

namespace App\Models;

use Core\Hash;
use DB;
use PDO;

class User
{

    private static $data = array('id', 'username', 'name', 'email', 'phone_number', 'password', 'address', 'state', 'create_date', 'update_date');

    public static function getDataByUsername($username, $data = null)
    {
        return DB::table('customer')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('username', $username)->first();
    }

    public static function getDataById($id, $data = null)
    {
        return DB::table('customer')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('id', $id)->first();
    }

    public static function getDataByEmail($email, $data = null)
    {
        return DB::table('customer')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('email', $email)->first();
    }

    public static function userExists($username)
    {
        return DB::table('customer')->select('username')->where('username', $username)->first();
    }

    public static function create($data)
    {
        $t = time();
        $data = array(
            'username' => $data->username,
            'name' => $data->name,
            'password' => Hash::md5($data->password),
            'email' => $data->email,
            'phone_number' => $data->phone_number,
            'create_date' => $t,
            'update_date' => $t
        );

        $id = DB::table('customer')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->insert($data);

        return $id;
    }

    public static function updateUserName($id, $name)
    {
        $data = array(
            'name' => $name
        );

        return DB::table('customer')->where('id', $id)->update($data);
    }

    public static function updateEmail($id, $email)
    {
        $data = array(
            'email' => $email
        );

        return DB::table('customer')->where('id', $id)->update($data);
    }

    public static function updatePhone($id, $phone)
    {
        $data = array(
            'phone_number' => $phone
        );

        return DB::table('customer')->where('id', $id)->update($data);
    }

    public static function updatePassword($id, $pass)
    {
        $data = array(
            'password' => $pass
        );

        return DB::table('customer')->where('id', $id)->update($data);
    }

    public static function hasRole($id, $role)
    {
        return DB::table('customer')->select($data ?? static::$data)->where('id', $id)->where('role_id', $role)->count();
    }
}
