<?php


namespace App\controller;


use App\Interfaces\IController;
use App\model\User;
use App\Route\Router;
use App\traits\Helper;

class UserController extends BaseController implements IController
{
    use Helper;

    public function __construct()
    {
        session_start();
        parent::__construct();
    }

    public function index()
    {
        $userId = (new Router())->getParam();
        $user = (new User())->getUserById($userId);
        $user->phone = $this->parseNumber($user->phone);
        $this->setView(['user' => $user]);
    }

    public function setView(array $data)
    {
        $user = $data['user'];
        $content = include('src/views/contact.php');
        return $content;
    }

    public static function addUser()
    {
        session_start();
        $data = $_POST['formData'];
        $res = [];
        parse_str($data,$res);

        $firstname = $res['firstname'];
        $lastname = $res['lastname'];
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
            $user->save();
            $lastId = $user->getLastId();
            $path = false;

            if ($_FILES) {
               $path = self::editUserLogo($lastId, false);
            }

            if ($path) {
                $user->setLogopath($path);
            }
        }
        echo json_encode($user);
    }

    public function editUser()
    {
        $userId = $_POST['id'];
        $property = $_POST['property'];
        $input = $_POST['input'];
        $user = (new User())->getUserById($userId);
        $user->{$property} = $input;
        $user->save();
    }

    public static function editUserLogo($userId = null, $json = true)
    {
        $files = $_FILES;

        if ( ! $userId) {
            $userId = $_POST['userId'];
        }

        $logoDir = 'public/assets/userlogos/' . $userId;
        $uuid = uniqid();

        foreach ($files as $file) {
            if ($file['type'] !== "image/jpeg" && $file['type'] !== "image/png") {
                return;
            }
            if ($file['size'] > 2097152) {
                return;
            }
        }

        if ( ! is_dir($logoDir)) {
           mkdir($logoDir);
        } else {
            $oldFiles = scandir($logoDir);
            foreach ($oldFiles as $oldFile) {
                unlink($logoDir .'/'.$oldFile);
            }
        }

        foreach ($files as $file) {
            $fileExt = explode('.',$file['name'])[1];
            $filename = $uuid . '.'.$fileExt;
            move_uploaded_file($file['tmp_name'], $logoDir . '/' . $filename);
            chmod($logoDir . '/'.$filename, 0777);
            /** @var User $user */
            $user = (new User())->getUserById($userId);
            $user->setUuid($uuid);
            $user->save();
        }

        if ($json) {
            echo json_encode($user->getUserLogoPath());
        } else {
            return $user->getUserLogoPath();
        }
    }
}