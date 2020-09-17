<?php


namespace App\Controller;

use App\Interfaces\IController;
use App\model\User;

class LoginController extends BaseController implements IController
{
    public function index()
    {
        session_start();
        $vars = [
            'data'=> 'data'
        ];
        $this->setView($vars);
    }

    public function setView( array $vars)
    {
        $content = include('src/views/login.php');
        return $content;
    }

    public static function loginCheck()
    {
        session_start();
        $data = $_POST['data'];
        $res = [];
        parse_str($data,$res);

        $login = $res['email'];
        $password = $res['password'];
        $user = (new User())->getUserByEmail($login);

        if ($user) {
            $passwordVerify = password_verify($password, $user['password']);

            if ($passwordVerify) {
                $_SESSION['user_loggedIn'] = true;
                $_SESSION['user_id'] = $user['id'];
                $status = 1;
                $userLoggedIn = true;
            } else {
                $status = 'Incorrect password';
            }
        } else {
            $status =  'User not found';
        }
        echo json_encode(['status' => $status, 'userLoggedIn' => $userLoggedIn]);
    }

    public function logout()
    {
        session_start();
        $_SESSION['user_loggedIn'] = false;
        session_destroy();
        header('Location: /login');
    }
}