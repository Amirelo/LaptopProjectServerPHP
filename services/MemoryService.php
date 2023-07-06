<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/memory.php';

class MemoryService{
    private $connection;
    private $table_name= "TBL_MEMORY";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllMemories(){
        $sql = "SELECT MEMORYID,CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listMemories = [];
        while($row = $stmt->fetch()){
            extract($row);
            $memory = new Memory($MEMORYID,$CURRENTRAM,$TYPE,$SPEED,$MAXSLOTS,$AVAILABLESLOTS,$MAXRAM,$STATUS);
            array_push($listMemories, $memory);
        }
        return new Response(1,"Get all memory success", $listMemories);
    }

    public function getMemoryByID($memoryID){
        $sql = "SELECT MEMORYID,CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS FROM ".$this->table_name." WHERE MEMORYID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$memoryID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listMemories = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $memory = new memory($MEMORYID,$CURRENTRAM,$TYPE,$SPEED,$MAXSLOTS,$AVAILABLESLOTS,$MAXRAM,$STATUS);
            array_push($listMemories, $memory);
        }
        return new Response(1,"Get memory by id success", $listMemories);
    }

    public function insertMemoryInfo($currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam){
        $sql = "INSERT INTO ".$this->table_name." (CURRENTRAM,TYPE,SPEED,MAXSLOTS,AVAILABLESLOTS,MAXRAM,STATUS) VALUES(?,?,?,?,?,?, true)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$currentRAM); 
        $stmt->bindParam(2,$type);
        $stmt->bindParam(3,$speed); 
        $stmt->bindParam(4,$maxSlots);
        $stmt->bindParam(5,$availableSlots); 
        $stmt->bindParam(6,$maxRam); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert memory success", null);
        } else{
            $response = new Response(0, "Fail to add memory, possibly dupplication", null);
        }
        return $response;
    }

    public function updateMemoryByID($memoryID,$currentRAM,$type,$speed,$maxSlots,$availableSlots,$maxRam, $status){
        $sql = "UPDATE ".$this->table_name." SET CURRENTRAM=?, TYPE=?, SPEED=?,MAXSLOTS=?,AVAILABLESLOTS=?,MAXRAM=?, STATUS=b? WHERE MEMORYID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$currentRAM); 
        $stmt->bindParam(2,$type);
        $stmt->bindParam(3,$speed); 
        $stmt->bindParam(4,$maxSlots);
        $stmt->bindParam(5,$availableSlots); 
        $stmt->bindParam(6,$maxRam); 
        $stmt->bindParam(7,$status); 
        $stmt->bindParam(8,$memoryID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update memory success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>