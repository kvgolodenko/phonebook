<?php


namespace App\Controller;


use App\Interfaces\IController;
use App\model\User;
use http\QueryString;

class RegisterController extends BaseController implements IController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $vars = [
            'data'=> 'data'
        ];
        $this->setView($vars);
    }

    public function setView(array $data)
    {
        $content = include ('src/views/register.php');

        return $content;
    }

    public function register()
    {
        $data = $_POST['data'];
        $res = [];
        parse_str($data,$res);

        $firstname = $res['name'];
        $lastname = $res['surname'];
        $phone = $res['phone'];
        $email = $res['email'];
        $password = $res['password'];

        $user = new User();

        if ( ! $user->checkExistingUser($email)) {
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setPhone($phone);
            $user->setEmail($email);
            $user->setPassword($password);
            $result = $user->save();
        }

    }
}