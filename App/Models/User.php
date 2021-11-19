<?php

namespace App\Models;

use Core\Hash;
use DB;
use PDO;

class User
{

    private static $data = array('id', 'nama', 'first_name', 'last_name', 'no_telefon', 'kata_laluan', 'email', 'alamat', 'negeri');

    public static function getDataByUsername($username, $data = null)
    {
        return DB::table('pelanggan')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('nama', $username)->first();
    }

    public static function getDataById($id, $data = null)
    {
        return DB::table('pelanggan')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('id', $id)->first();
    }

    public static function getDataByEmail($email, $data = null)
    {
        return DB::table('pelanggan')->select($data ?? static::$data)->setFetchMode(PDO::FETCH_CLASS, get_called_class())->where('email', $email)->first();
    }

    public static function userExists($username)
    {
        return DB::table('pelanggan')->select('nama')->where('nama', $username)->first();
    }

    public static function create($data)
    {
        $data = array(
            'nama' => $data->username,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'kata_laluan' => Hash::md5($data->password),
            'email' => $data->email
        );

        $id = DB::table('pelanggan')->setFetchMode(PDO::FETCH_CLASS, get_called_class())->insert($data);

        return $id;
    }
}