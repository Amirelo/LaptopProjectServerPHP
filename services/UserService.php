<?php 
include_once '../dbconfigs/dbconfig.php';
include_once '../models/Response.php';

class UserService{
    private $connection;
    private $table_name = "USER";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function checkEmail($email, $type){
        $sql = "SELECT * FROM ".$this->table_name." WHERE EMAIL = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt -> bindParam(1, $email);
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();
        if($stmt -> rowCount() >0){
            if($type == 1){
                $response = new Response(0, "Email already registered!", null);
                
            } else{
                $response = new Response(1, "Redirect to verification screen", null);
            }
        } else{
            if($type == 1){
                $response = new Response(1,"You can use this email", null);
                
            } else{
                $response = new Response(0, "This email is not registered with us", null);
            }
        }
        return $response;
        
    }

    public function insertUser($username, $userPassword, $email, $phonenumber,$fullname, $gender, $birthday){
        $response = $this->checkEmail($email, 1);
        if ($response->response_code == 1){
            $createdate = date('Y-m-d H:i:s');
            $accountStatus = 1;
            $isAdmin = false;
            $imageLink = "https://cdn.pixabay.com/photo/2023/05/28/00/34/sunset-8022573_1280.jpg";

            $sql = "INSERT INTO ".$this->table_name." (username,userPassword,email,phonenumber,fullname,createdate,gender,accountStatus, isAdmin,birthday, imageLink) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

            $stmt = $this->connection->prepare($sql);
            $stmt -> bindParam(1, $username);
            $stmt -> bindParam(2, $userPassword);
            $stmt -> bindParam(3, $email);
            $stmt -> bindParam(4, $phonenumber);
            $stmt -> bindParam(5, $fullname);
            $stmt -> bindParam(6, $createdate);
            $stmt -> bindParam(7, $gender);
            $stmt -> bindParam(8, $accountStatus);
            $stmt -> bindParam(9, $isAdmin);
            $stmt -> bindParam(10, $birthday);
            $stmt -> bindParam(11, $imageLink);

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $response = new Response(1, "Sign Up successful", null);
            } else{
                $response = new Response(0, "Sign Up Fail", null);
            }
        } else{
            $response = new Response(0, "Email already registered", null);
        }
        return $response;
    }
}

?>