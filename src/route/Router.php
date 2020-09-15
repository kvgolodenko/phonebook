<?php
namespace App\Route;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\controller\UserController;

class Router
{
    public $route;

    public function __construct()
    {
        $this->route = $_SERVER['REQUEST_URI'];
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function __invoke()
    {
        switch ($this->route) {
            case '/':
            case '/homepage':
                (new HomeController())->index();
                break;
            case '/login':
                (new LoginController())->index();
                break;
            case '/registration':
                (new RegisterController())->index();
                break;
            case '/register':
                (new RegisterController())->register();
                break;
            case '/loginCheck':
                LoginController::loginCheck();
                break;
            case '/logout':
                (new LoginController)->logout();
                break;
            case('/addUser'):
                (new UserController())->addUser();
                break;
            default:
                echo '404 No such page ';
                break;
        }
    }
}