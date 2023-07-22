<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/screen.php';

class ScreenService{
    private $connection;
    private $table_name= "TBL_SCREEN";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllScreens(){
        $sql = "SELECT SCREENID, RESOLUTION, SCREENSIZE,STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listScreens = [];
        while($row = $stmt->fetch()){
            extract($row);
            $screen = new Screen($SCREENID, $RESOLUTION,$SCREENSIZE,$STATUS);
            array_push($listScreens, $screen);
        }
        return new Response(1,"Get all screen success", $listScreens);
    }

    public function getScreensByID($screenID){
        $sql = "SELECT SCREENID, RESOLUTION, SCREENSIZE,STATUS FROM ".$this->table_name." WHERE SCREENID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$screenID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listScreens = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $screen = new Screen($SCREENID, $RESOLUTION,$SCREENSIZE,$STATUS);
            array_push($listScreens, $screen);
        }
        return new Response(1,"Get screen by id success", $listScreens);
    }

    public function insertScreenInfo($resolution,$screenSize){
        $sql = "INSERT INTO ".$this->table_name." (RESOLUTION, SCREENSIZE,STATUS) VALUES(?,?, true)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$resolution); 
        $stmt->bindParam(2,$screenSize);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert screen success", null);
        } else{
            $response = new Response(0, "Fail to add screen, possibly dupplication", null);
        }
        return $response;
    }

    public function updateScreenByID($screenID,$resolution,$screenSize, $status){
        $sql = "UPDATE ".$this->table_name." SET RESOLUTION=?, SCREENSIZE=?,STATUS=b? WHERE SCREENID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt ->bindParam(1,$resolution);
        $stmt ->bindParam(2,$screenSize);
        $stmt ->bindParam(3,$status);
        $stmt ->bindParam(4,$screenID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update screen success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>