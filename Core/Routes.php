<?php

namespace Core;

use App\Handler\ExceptionHandler;
use App\Middleware\AdminMiddleware;
use App\Middleware\AuthMiddleware;
use App\Middleware\LoggedInMiddleware;
use App\Middleware\NotLoggedInMiddleware;
use Pecee\SimpleRouter\Route\Route;
use Pecee\SimpleRouter\SimpleRouter as Router;

class Routes extends Router
{
    public static function init()
    {
        Router::setDefaultNamespace('\App\Controllers');

        Router::group(['middleware' => AuthMiddleware::class], function () {

            Router::group(['middleware' => LoggedInMiddleware::class, 'exceptionHandler' => ExceptionHandler::class], function () {
                Router::get('/', 'Home\home@index');
                Router::get('/product', 'Product\ProductController@index');

                // if (request()->getMethod() == "post") {
                //     Router::post('/cart/add', 'Cart\CartController@add');
                //     Router::post('/cart/edit/{id}', 'Cart\CartController@edit');
                //     Router::post('/cart/delete/{id}', 'Cart\CartController@delete');
                //     Router::post('/cart/order', 'Cart\OrderController@order');
                //     Router::post('/account/user/name/{id}', 'User\ProfileController@updatename');
                //     Router::post('/account/user/email/{id}', 'User\ProfileController@updateemail');
                //     Router::post('/account/user/phone/{id}', 'User\ProfileController@updatephone');
                //     Router::post('/account/user/password/{id}', 'User\ProfileController@updatepassword');
                // }
            });

            Router::group(['middleware' => NotLoggedInMiddleware::class], function () {
                Router::get('/order/{ordernumber}', 'Cart\OrderController@details');
                Router::get('/shipping', 'Cart\ShippingController@index');
                Router::get('/cart', 'Cart\CartController@index');
                Router::get('/auth', 'Home\home@test');
                Router::get('/logout', 'Auth\Login@logout');
                Router::get('/account', 'User\ProfileController@index');
                Router::get('/account/user/password', 'User\ProfileController@indexPassword');
                Router::get('/account/purchases', 'User\ProfileController@purchases');

                Router::group(['middleware' => AdminMiddleware::class], function () {
                    Router::get('/admin', 'Admin\Home@index');
                    Router::get('/admin/customer/account', 'Admin\Customer\ProfileController@index');


                    if (request()->getMethod() == "post") {
                        Router::post('/admin/customer/account/delete/{id}', 'Admin\Customer\ProfileController@delete');
                        Router::post('/admin/customer/account/edit/{id}', 'Admin\Customer\ProfileController@update');
                        Router::post('/admin/customer/account/incoming/order', 'Admin\Customer\ProfileController@incomingorder');
                    }
                });
            });

            Router::partialGroup('{dir}/{controller}/{action}', function ($dir, $controller, $action) {
                if (request()->getMethod() == "post") {
                    Router::post('/', @ucfirst($dir) . '\\' . @ucfirst($controller) . '@' . $action);
                }
            });

            if (request()->getMethod() == "post") {
                Router::post('/login', 'Auth\Login@request');
                Router::post('/register', 'Auth\Register@request');
                Router::post('/cart/add', 'Cart\CartController@add');
                Router::post('/cart/edit/{id}', 'Cart\CartController@edit');
                Router::post('/cart/delete/{id}', 'Cart\CartController@delete');
                Router::post('/cart/order', 'Cart\OrderController@order');
                Router::post('/account/user/name/{id}', 'User\ProfileController@updatename');
                Router::post('/account/user/email/{id}', 'User\ProfileController@updateemail');
                Router::post('/account/user/phone/{id}', 'User\ProfileController@updatephone');
                Router::post('/account/user/password/{id}', 'User\ProfileController@updatepassword');
            }
        });

        Router::start();
    }
}
