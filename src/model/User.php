<?php


namespace App\model;


class User extends Model
{
    public $id;

    public $firstname;

    public $lastname;

    public $email;

    public $password;

    public $phone;

    public $userId;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = password_hash($password,PASSWORD_DEFAULT);
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->userId = $user_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }


    public function save()
    {
        $params = [
            ':firstname' => $this->firstname,
            ':lastname' => $this->lastname,
            ':email' => $this->email,
            ':password' => $this->password,
            ':phone' => $this->phone,
            ':userId' => $this->userId
        ];

        $sql = "INSERT INTO users (
            firstname,
            lastname,
            email,
            password,
            phone,
            user_id
        )
        VALUES (
            :firstname,
            :lastname,
            :email,
            :password,
            :phone,
            :userId
        )";

        return $this->request($sql, $params);
    }

    public function checkExistingUser($usermail)
    {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1 OFFSET 0";
        $params = [':email' => $usermail];

        return $this->fetch($sql, $params);
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $params = [':email' => $email];

        $result = $this->fetch($sql, $params);

        return  $result;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $params = [':id' => $id];

        $result = $this->fetch($sql, $params);

        return  $result;
    }

    public function getUsersByOwnerId($ownerId)
    {
        $sql = "SELECT * FROM users WHERE user_id = :user_id";

        $params = [':user_id' => $ownerId];

        $result = $this->fetchAll($sql, $params);

        return  $result;
    }

    public function parseNumber($number)
    {
        if ($number > 999999999999) {
            return;
        }
        $singleArray = ['','один','два','три','четыре','пять','шесть','семь','восемь','девять'];
        $decimalArray = ['','одиннадцать','двенадцать','тринадцать','четырнадцать','пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'];
        $decimalBigArray = ['','десять','двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят','восемьдесят','девяносто'];
        $hundredsArray= ['','сто', 'двести','триста','четыреста','пятсот', 'шестьсот', 'семьсот','восемьсот','девятьсот'];


        $array = [];
        $resultArray = [];
        $length =  strlen($number);

        for ($i = -3; $i > -$length; $i = $i - 3) {
            $array[] = substr($number, $i,3);
        }
        $array[] = substr($number, 0, $length + $i + 3);
//        $array = array_reverse($array);

        foreach ($array as $key => $item) {
            $string = '';
            switch (strlen($item)) {
                case 2:
                    $item = '0'.$item;
                    break;
                case 1:
                    $item = '00'.$item;
                    break;
            }
            for ($i=0;$i<=2;$i++){
                $number = substr($item,$i,1);
                switch ($i){
                    case 0:
                        $string .= $hundredsArray[$number] .' ';
                        break;
                    case 1:
                        if ($number == 1) {
                            $decimalNumber = substr($item,$i+1,1);
                            $string .= $decimalArray[$decimalNumber] . ' ';
                        } else {
                            $string .= $decimalBigArray[$number] . ' ';
                        }
                        break;
                    case 2:
                        if ( ! $decimalNumber) {
                            $string .= $singleArray[$number] . ' ';
                        }
                        break;

                }
            }
            switch ($key) {
                case 0:
                    break;
                case 1:
                    $string .='тысячи ';
                    break;
                case 2:
                    $string .='миллиона ';
                    break;
            }
            $resultArray[] = $string;
        }
        return implode(array_reverse($resultArray));
    }
}