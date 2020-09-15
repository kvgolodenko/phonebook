<?php


namespace App\controller;


use App\Interfaces\IController;
use App\model\User;

class UserController extends BaseController implements IController
{
    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        // TODO: Implement index() method.
    }

    public function setView(array $data)
    {
        // TODO: Implement setView() method.
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
        echo json_encode(['userId' => $_SESSION['user_id']]);
    }
}