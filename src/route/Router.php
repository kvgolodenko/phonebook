<?php
namespace App\Route;

use App\Controller\HomeController;
use App\Controller\LoginController;
use App\Controller\RegisterController;
use App\controller\UserController;

class Router
{
    public $route;

    public $param;

    public function __construct()
    {
        $this->route = explode('/',$_SERVER['REQUEST_URI'])[1];
        $this->param = explode('/',$_SERVER['REQUEST_URI'])[2];
    }

    /**
     * @return mixed|string
     */
    public function getParam()
    {
        return $this->param;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function __invoke()
    {
        switch ($this->route) {
            case '':
            case 'homepage':
                (new HomeController())->index();
                break;
            case 'login':
                (new LoginController())->index();
                break;
            case 'registration':
                (new RegisterController())->index();
                break;
            case 'register':
                (new RegisterController())->register();
                break;
            case 'loginCheck':
                LoginController::loginCheck();
                break;
            case 'logout':
                (new LoginController)->logout();
                break;
            case('addUser'):
                (new UserController())->addUser();
                break;
            case('editUser'):
                (new UserController())->editUser();
                break;
            case('editUserLogo'):
                UserController::editUserLogo();
                break;
            case('contact'):
                (new UserController())->index();
                break;
            default:
                echo '404 No such page ';
                break;
        }
    }
}