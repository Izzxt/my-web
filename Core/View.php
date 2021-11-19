<?php

namespace Core;

use App\Models\Cart;
use App\Models\User;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

//Load the model and the view
class View
{
    public static function model($model)
    {
        //Require model file
        require_once '../App/Models/' . $model . '.php';
        //Instantiate model
        return new $model();
    }

    //Load the view (checks for the file)
    public static function view($view, $data = [])
    {
        if (file_exists('../App/Views/' . $view . '.php')) {
            require_once '../App/Views/includes/header.php';
            require_once '../App/Views/' . $view . '.php';
            require_once '../App/Views/includes/footer.php';
        } else {
            die("View does not exists.");
        }
    }

    public static function renderTemplate($view, $args = [])
    {
        static $twig = null;
        if ($twig === null) {
            $loader = new FilesystemLoader(dirname(__DIR__) . '/App/View');
            $twig = new Environment($loader, [
                'debug' => true
            ]);
            $twig->addExtension(new \Twig\Extension\DebugExtension());

            if (request()->user !== null) {
                $twig->addGlobal('user', User::getDataById(request()->user->id));
                $twig->addGlobal('cart_count', Cart::getRowCountByUserId(request()->user->id));
            }
        }

        echo $twig->render($view, $args);
    }
}
