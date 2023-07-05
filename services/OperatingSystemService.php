<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/operatingSystem.php';

class OperatingSystemService{
    private $connection;
    private $table_name= "TBL_OPERATINGSYSTEM";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllOperatingSystems(){
        $sql = "SELECT OPERATINGSYSTEMID, OS, VERSION, TYPE, STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listOperatingSystem = [];
        while($row = $stmt->fetch()){
            extract($row);
            $operatingSystem = new OperatingSystem($OPERATINGSYSTEMID, $OS,$VERSION, $TYPE,$STATUS);
            array_push($listOperatingSystem, $operatingSystem);
        }
        return new Response(1,"Get all operating system success", $listOperatingSystem);
    }

    public function getOperatingSystemByID($operatingSystemID){
        $sql = "SELECT OPERATINGSYSTEMID,OS, VERSION, TYPE, STATUS FROM ".$this->table_name." WHERE OPERATINGSYSTEMID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$operatingSystemID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listOperatingSystem = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $operatingSystem = new OperatingSystem($OPERATINGSYSTEMID, $OS,$VERSION, $TYPE,$STATUS);
            array_push($listOperatingSystem, $operatingSystem);
        }
        return new Response(1,"Get operating system by id success", $listOperatingSystem);
    }

    public function insertOperatingSystem($OS,$version, $type){
        $sql = "INSERT INTO ".$this->table_name." (OS, VERSION,TYPE,STATUS) VALUES(?,?,?,1)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$OS); 
        $stmt->bindParam(2,$version); 
        $stmt->bindParam(3,$type); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert operating system success", null);
        } else{
            $response = new Response(0, "Fail to add operating system, possibly dupplication", null);
        }
        return $response;
    }

    public function updateOperatingSystemByID($operatingSystemID,$OS,$version, $type, $status){
        $sql = "UPDATE ".$this->table_name." SET OS=?, VERSION=?, TYPE=?, STATUS=b? WHERE OPERATINGSYSTEMID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt ->bindParam(1,$OS);
        $stmt ->bindParam(2,$version);
        $stmt ->bindParam(3,$type);
        $stmt ->bindParam(4,$status);
        $stmt ->bindParam(5,$operatingSystemID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update operating systme success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>