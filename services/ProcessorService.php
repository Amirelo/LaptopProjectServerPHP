<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/processor.php';

class ProcessorService{
    private $connection;
    private $table_name= "TBL_PROCESSOR";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllProcessors(){
        $sql = "SELECT PROCESSORID, NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProcessors = [];
        while($row = $stmt->fetch()){
            extract($row);
            $processor = new processor($PROCESSORID, $NAME,$CPU_SPEED,$CORES,$LOGICALPROCESSORS,$CACHEMEMORY,$STATUS);
            array_push($listProcessors, $processor);
        }
        return new Response(1,"Get all processor success", $listProcessors);
    }

    public function getProcessorsByID($processorID){
        $sql = "SELECT PROCESSORID, NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS FROM ".$this->table_name." WHERE PROCESSORID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$processorID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProcessors = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $processor = new processor($PROCESSORID, $NAME,$CPU_SPEED,$CORES,$LOGICALPROCESSORS,$CACHEMEMORY,$STATUS);
            array_push($listProcessors, $processor);
        }
        return new Response(1,"Get processor by id success", $listProcessors);
    }

    public function insertProcessorInfo($name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory){
        $sql = "INSERT INTO ".$this->table_name." (NAME, CPU_SPEED,CORES,LOGICALPROCESSORS,CACHEMEMORY,STATUS) VALUES(?,?,?,?,?, true)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$name); 
        $stmt->bindParam(2,$CPU_Speed);
        $stmt->bindParam(3,$cores); 
        $stmt->bindParam(4,$logicalProcessors);
        $stmt->bindParam(5,$cacheMemory); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert processor success", null);
        } else{
            $response = new Response(0, "Fail to add processor, possibly dupplication", null);
        }
        return $response;
    }

    public function updateProcessorByID($processorID,$name,$CPU_Speed,$cores,$logicalProcessors, $cacheMemory, $status){
        $sql = "UPDATE ".$this->table_name." SET NAME=?, CPU_SPEED=?, CORES=?,LOGICALPROCESSORS=?,CACHEMEMORY=?,STATUS=b? WHERE PROCESSORID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt ->bindParam(1,$name);
        $stmt ->bindParam(2,$CPU_Speed);
        $stmt ->bindParam(3,$cores);
        $stmt ->bindParam(4,$logicalProcessors);
        $stmt ->bindParam(5,$cacheMemory);
        $stmt ->bindParam(6,$status);
        $stmt ->bindParam(7,$processorID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update processor success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>