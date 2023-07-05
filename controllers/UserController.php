<?php 
include_once '../../services/UserService.php';

class UserController{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function checkEmail($email, $type){
        return $this -> userService -> checkEmail($email, $type);
    }

    public function checkPhoneNumber($phoneNumber){
        return $this -> userService -> checkPhoneNumber($phoneNumber);
    }

    public function signUp($username, $userPassword, $email, $phonenumber,$fullname, $gender, $birthday){
        return $this -> userService -> insertUser($username, $userPassword, $email, $phonenumber,$fullname, $gender, $birthday);
    }

    public function signIn($username, $userPassword){
        return $this->userService->signIn($username, $userPassword);
    }

    public function updateUserInfo($data, $email, $type){
        return $this->userService->updateUserInfo($data,$email,$type);
    }
}


?>