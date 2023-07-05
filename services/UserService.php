<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/Response.php';

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
        $sql = "SELECT * FROM " . $this->table_name . " WHERE EMAIL = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            if ($type == 1) {
                $response = new Response(0, "Email already registered!", null);
            } else {
                $response = new Response(1, "Redirect to verification screen", null);
            }
        } else {
            if ($type == 1) {
                $response = new Response(1, "You can use this email", null);
            } else {
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

    public function checkUserName($username){
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
        if ($this->checkEmail($email, 1)->response_code != 1) {
            return new Response(0, "Email already registered", null);
        }
        if ($this->checkPhoneNumber($phonenumber)->response_code != 1) {
            return new Response(0, "Phone number already registered", null);
        }
        if ($this->checkUserName($username)->response_code != 1) {
            return new Response(0, "Username already in use", null);
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
        $sql = "SELECT username, userPassword FROM " . $this->table_name . " WHERE username = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userPassword == $row['userPassword']) {
                $response = new Response(1, "Sign In successful", null);
            } else {
                $response = new Response(0, "Wrong username or password", null);
            }
        } else {
            $response = new Response(0, "Wrong username or password", null);
        }
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
