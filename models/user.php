<?php 
class Users{
    private $userId;
    private $username;
    private $password;
    private $email;
    private $phonenumber;
    private $fullname;
    private $imageLink;
    private $createdate;
    private $gender;
    private $accountStatus;
    private $isAdmin;
    private $birthday;

    public function __construct($userId, $username, $password, $email, $phonenumber,$fullname, $imageLink, $createdate, $gender, $accountStatus, $isAdmin, $birthday){
        $this->userId = $userId;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phonenumber = $phonenumber;
        $this->fullname = $fullname;
        $this->imageLink = $imageLink;
        $this->createdate = $createdate;
        $this->gender = $gender;
        $this->accountStatus = $accountStatus;
        $this->birthday = $birthday;
        $this->isAdmin = $isAdmin;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function getUsername(){
        return $this->username;
    }
    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }
    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setFullName($fullname){
        $this->fullname = $fullname;
    }

    public function getFullName(){
        return $this->fullname;
    }
    public function setimageLink($imageLink){
        $this->imageLink = $imageLink;
    }

    public function getimageLink(){
        return $this->imageLink;
    }
    public function setPhoneNumber($phonenumber){
        $this->phonenumber = $phonenumber;
    }

    public function getPhoneNumber(){
        return $this->phonenumber;
    }
    
    public function setCreateDate($createdate){
        $this->createdate = $createdate;
    }

    public function getCreateDate(){
        return $this->createdate;
    }
    public function setBirthday($birthday){
        $this->birthday = $birthday;
    }

    public function getBirthday(){
        return $this->birthday;
    }

    public function setGender($gender){
        $this->gender = $gender;
    }

    public function getGender(){
        return $this->gender;
    }

    public function setAccountStatus($accountStatus){
        $this->accountStatus = $accountStatus;
    }

    public function getAccountStatus(){
        return $this->accountStatus;
    }

    public function setIsAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }
   
}
?>