<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/storage.php';

class StorageService{
    private $connection;
    private $table_name= "TBL_STORAGE";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllStorages(){
        $sql = "SELECT STORAGEID,TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listStorages = [];
        while($row = $stmt->fetch()){
            extract($row);
            $storage = new Storage($STORAGEID,$TYPE,$MAXSLOTS,$AVAILABLESLOTS,$CURRENTSTORAGE,$STATUS);
            array_push($listStorages, $storage);
        }
        return new Response(1,"Get all storage success", $listStorages);
    }

    public function getStorageByID($storageID){
        $sql = "SELECT STORAGEID,TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS FROM ".$this->table_name." WHERE STORAGEID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$storageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listStorages = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $storage = new Storage($STORAGEID,$TYPE,$MAXSLOTS,$AVAILABLESLOTS,$CURRENTSTORAGE,$STATUS);
            array_push($listStorages, $storage);
        }
        return new Response(1,"Get storage by id success", $listStorages);
    }

    public function insertStorageInfo($type,$maxSlots,$availableSlots,$currentStorage){
        $sql = "INSERT INTO ".$this->table_name." (TYPE,MAXSLOTS,AVAILABLESLOTS,CURRENTSTORAGE,STATUS) VALUES(?,?,?,?, true)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$type); 
        $stmt->bindParam(2,$maxSlots);
        $stmt->bindParam(3,$availableSlots); 
        $stmt->bindParam(4,$currentStorage);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert storage success", null);
        } else{
            $response = new Response(0, "Fail to add storage, possibly dupplication", null);
        }
        return $response;
    }

    public function updateStorageByID($storageID,$type,$maxSlots,$availableSlots,$currentStorage, $status){
        $sql = "UPDATE ".$this->table_name." SET TYPE=?, MAXSLOTS=?, AVAILABLESLOTS=?,CURRENTSTORAGE=?,STATUS=b? WHERE STORAGEID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$type); 
        $stmt->bindParam(2,$maxSlots);
        $stmt->bindParam(3,$availableSlots); 
        $stmt->bindParam(4,$currentStorage);
        $stmt->bindParam(5,$status); 
        $stmt->bindParam(6,$storageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update storage success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>