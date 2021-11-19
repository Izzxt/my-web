<?php

namespace Core;

use App\Handler\ExceptionHandler;
use App\Middleware\AuthMiddleware;
use App\Middleware\LoggedInMiddleware;
use App\Middleware\NotLoggedInMiddleware;
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

                if (request()->getMethod() == "post") {
                    Router::post('/cart/add', 'Cart\CartController@add');
                    Router::post('/cart/edit/{id}', 'Cart\CartController@edit');
                    Router::post('/cart/delete/{id}', 'Cart\CartController@delete');
                    Router::post('/cart/order', 'Cart\ShippingController@order');
                }
            });

            Router::group(['middleware' => NotLoggedInMiddleware::class], function () {
                Router::get('/order/{ordernumber}', 'Cart\OrderController@details');
                // Router::get('/order', 'Cart\OrderController@details');
                Router::get('/shipping', 'Cart\ShippingController@index');
                Router::get('/cart', 'Cart\CartController@index');
                Router::get('/auth', 'Home\home@test');
                Router::get('/logout', 'Auth\Login@logout');
            });

            Router::partialGroup('{dir}/{controller}/{action}', function ($dir, $controller, $action) {
                if (request()->getMethod() == "post") {
                    Router::post('/', @ucfirst($dir) . '\\' . @ucfirst($controller) . '@' . $action);
                }
            });

            if (request()->getMethod() == "post") {
                Router::post('/login', 'Auth\Login@request');
                Router::post('/register', 'Auth\Register@request');
            }
        });

        Router::start();
    }
}
