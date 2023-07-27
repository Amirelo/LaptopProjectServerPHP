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

    public function adminSignIn($username, $userPassword){
        return $this->userService->adminSignIn($username, $userPassword);
    }

    public function updateUserInfo($data, $email, $type){
        return $this->userService->updateUserInfo($data,$email,$type);
    }

    public function getUserByUsername($username){
        return $this->userService->getUserByUsername($username);
    }

    public function getUserByEmail($email){
        return $this->userService->getUserByEmail($email);
    }


    public function getAllUsers(){
        return $this->userService->getAllUsers();
    }
}


?>