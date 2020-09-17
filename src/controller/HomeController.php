<?php


namespace App\Controller;


use App\Interfaces\IController;
use App\Database\DB;
use App\model\User;

class HomeController extends BaseController implements IController
{
    public function index()
    {
        session_start();
        $loggedIn = $_SESSION['user_loggedIn'];
        $userId = $_SESSION['user_id'];
        $users = (new User())->getUsersByOwnerId($userId);

        if ( ! $loggedIn) {
            header('Location: login');
        }

        $vars = [];
        $vars['header'] = 'Homepage';
        $vars['users'] = $users;
        $this->setView($vars);
    }

    public function setView(array $data)
    {
        $view = $data;
        $content = include ('src/views/home.php');

        return $content;
    }
}