<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/Response.php';
include_once '../../models/user.php';

class UserService
{
    private $connection;
    private $table_name = "TBL_USER";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }


    public function checkEmail($email, $type)
    {
        $response = null;
        $sql = "SELECT * FROM " . $this->table_name . " WHERE EMAIL = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            if ($type == "SIGNUP") {
                $response = new Response(0, "Email already registered!", null);
            }
            if ($type == "CHANGEPASSWORD") {
                $response = new Response(1, "Email found", null);
            }
        } else {
            if ($type == "SIGNUP") {
                $response = new Response(1, "You can use this email", null);
            }
            if ($type == "CHANGEPASSWORD") {
                $response = new Response(0, "This email is not registered with us", null);
            }
        }
        return $response;
    }

    public function checkPhoneNumber($phoneNumber)
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE PHONENUMBER = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $phoneNumber);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(0, "Phone number already registered!", null);
        } else {
            $response = new Response(1, "Phone number available", null);
        }
        return $response;
    }

    public function checkUserName($username)
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE USERNAME = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(0, "Username already in use!", null);
        } else {
            $response = new Response(1, "username available", null);
        }
        return $response;
    }


    public function insertUser($username, $userPassword, $email, $phonenumber, $fullname, $gender, $birthday)
    {
        if ($userPassword != null) {
            if ($this->checkEmail($email, "SIGNUP")->response_code != 1) {
                return new Response(0, "Email already registered", null);
            }
            if ($this->checkPhoneNumber($phonenumber)->response_code != 1) {
                return new Response(0, "Phone number already registered", null);
            }
            if ($this->checkUserName($username)->response_code != 1) {
                return new Response(0, "Username already in use", null);
            }
        }
        $createdate = date('Y-m-d H:i:s');
        $accountStatus = 1;
        $isAdmin = false;
        $imageLink = "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg";

        $sql = "INSERT INTO " . $this->table_name . " (username,userPassword,email,phonenumber,fullname,createdate,gender,accountStatus, isAdmin,birthday, imageLink) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $userPassword);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $phonenumber);
        $stmt->bindParam(5, $fullname);
        $stmt->bindParam(6, $createdate);
        $stmt->bindParam(7, $gender);
        $stmt->bindParam(8, $accountStatus);
        $stmt->bindParam(9, $isAdmin);
        $stmt->bindParam(10, $birthday);
        $stmt->bindParam(11, $imageLink);

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Sign Up successful", null);
        } else {
            $response = new Response(0, "Sign Up Fail", null);
        }
        return $response;
    }

    public function signIn($username, $userPassword)
    {
        $response = null;
        $sql = "SELECT USERNAME, USERPASSWORD,EMAIL FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userPassword == $row['USERPASSWORD']) {
                $user = new Users(null, $row['USERNAME'], null, $row['EMAIL'], null, null, null, null, null, null, null, null);
                $response = new Response(1, "Sign In successful", $user);
            } else {
                $response = new Response(0, "Wrong username or password", null);
            }
        } else {
            $response = new Response(0, "Wrong username or password", null);
        }
        return $response;
    }

    public function AdminSignIn($username, $userPassword)
    {
        $response = null;
        $sql = "SELECT USERNAME, USERPASSWORD,EMAIL,IMAGELINK FROM " . $this->table_name . " WHERE username = ? AND ISADMIN = TRUE";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userPassword == $row['USERPASSWORD']) {
                $user = new Users(null, $row['USERNAME'], null, $row['EMAIL'], null, null, $row['IMAGELINK'], null, null, null, null, null);
                $response = new Response(1, "Sign In successful", $user);
            } else {
                $response = new Response(0, "Wrong username or password", null);
            }
        } else {
            $response = new Response(0, "Wrong username or password", null);
        }
        return $response;
    }

    public function getUserByUsername($username)
    {
        $response = null;
        $sql = "SELECT USERID,USERNAME, USERPASSWORD,EMAIL,PHONENUMBER,FULLNAME,IMAGELINK,BIRTHDAY,GENDER FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $user = new Users($USERID, $USERNAME, null, $EMAIL, $PHONENUMBER, $FULLNAME, $IMAGELINK, null, $GENDER, null, null, $BIRTHDAY);
            $response = new Response(1, "Get current user successful", $user);
        } else {
            $response = new Response(0, "Get current user fail", null);
        }
        return $response;
    }

    public function getUserByEmail($email)
    {
        $response = null;
        $sql = "SELECT USERID,USERNAME, USERPASSWORD,EMAIL,PHONENUMBER,FULLNAME,IMAGELINK,BIRTHDAY,GENDER FROM " . $this->table_name . " WHERE EMAIL = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
            $user = new Users($USERID, $USERNAME, null, $EMAIL, $PHONENUMBER, $FULLNAME, $IMAGELINK, null, $GENDER, null, null, $BIRTHDAY);
            $response = new Response(1, "Get current user successful", $user);
        } else {
            $response = new Response(0, "Get current user fail", null);
        }
        return $response;
    }


    public function getAllUsers()
    {
        $response = null;
        $sql = "SELECT USERID,USERNAME, USERPASSWORD,EMAIL,PHONENUMBER,FULLNAME,IMAGELINK,BIRTHDAY,GENDER,ACCOUNTSTATUS FROM " . $this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listUsers = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $user = new Users($USERID, $USERNAME, null, $EMAIL, $PHONENUMBER, $FULLNAME, $IMAGELINK, null, $GENDER, $ACCOUNTSTATUS, null, $BIRTHDAY);
            array_push($listUsers, $user);
        }
        $response = new Response(1, "Get current user successful", $listUsers);
        return $response;
    }

    public function updatePassword($userPassword, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET userPassword=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userPassword);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateUserInfo($data, $email, $type)
    {
        switch ($type) {
            case "USERNAME":
                return $this->updateUsername($data, $email);
            case "FULLNAME":
                return $this->updateFullName($data, $email);
            case "IMAGELINK":
                return $this->updateImageLink($data, $email);
            case "BIRTHDAY":
                return $this->updateBirthday($data, $email);
            case "GENDER":
                return $this->updateGender($data, $email);
            case "PASSWORD":
                return $this->updatePassword($data, $email);
            case "EMAIL":
                return $this->updateEmail($data, $email);
            case "STATUS":
                return $this->updateAccountStatus($data, $email);
            case "PHONENUMBER":
                return $this->updatePhoneNumber($data, $email);
            default:
                return new Response(0, "Action not found", null);
        }
    }

    public function updateUsername($username, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET username=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updatePhoneNumber($phoneNumber, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET PHONENUMBER=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $phoneNumber);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateEmail($newEmail, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET email=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $newEmail);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateFullName($fullName, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET fullName=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $fullName);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateImageLink($imageLink, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET imageLink=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $imageLink);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateBirthday($birthday, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET birthday=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $birthday);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateGender($gender, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET gender=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $gender);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }

    public function updateAccountStatus($accountStatus, $email)
    {
        $response = null;
        $sql = "UPDATE " . $this->table_name . " SET accountStatus=? WHERE email=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $accountStatus);
        $stmt->bindParam(2, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->execute()) {
            $response = new Response(1, "Update success", null);
        }
        return $response;
    }
}
