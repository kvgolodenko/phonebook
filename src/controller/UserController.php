<?php


namespace App\controller;


use App\Interfaces\IController;
use App\model\User;
use App\Route\Router;

class UserController extends BaseController implements IController
{
    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        $userId = (new Router())->getParam();
        $user = (new User())->getUserById($userId);
        $this->setView($user);
    }

    public function setView(array $data)
    {
        $user = $data;
        $content = include('src/views/contact.php');
        return $content;
    }

    public static function addUser()
    {
        $data = $_POST['data'];
        $res = [];
        parse_str($data,$res);

        $firstname = $res['name'];
        $lastname = $res['surname'];
        $phone = $res['phone'];
        $email = $res['email'];
        $ownerId = $_SESSION['user_id'];

        $user = new User();

        if ( ! $user->checkExistingUser($email)) {
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPhone($phone);
            $user->setEmail($email);
            $user->setUserId($ownerId);
            $result = $user->save();
        }
        echo json_encode($user);
    }
}