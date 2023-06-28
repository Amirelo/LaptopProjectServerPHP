<?php 
include_once '../services/UserService.php';
class UserController{
    private $UserService;
    public function __construct()
    {
        $this->UserService = new UserService();
    }

    public function checkEmail($email, $type){
        return $this -> UserService -> checkEmail($email, $type);
    }

    public function SignUp($username, $userPassword, $email, $phonenumber,$fullname, $gender, $birthday){
        return $this -> UserService -> insertUser($username, $userPassword, $email, $phonenumber,$fullname, $gender, $birthday);
    }

    public function SignIn($username, $userPassword){
        return $this->UserService->SignIn($username, $userPassword);
    }
}


?>