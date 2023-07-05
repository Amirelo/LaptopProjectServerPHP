<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/brand.php';

class BrandService{
    private $connection;
    private $table_name= "TBL_BRAND";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllBrands(){
        $sql = "SELECT BRANDID, BRANDNAME, STATUS FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listBrands = [];
        while($row = $stmt->fetch()){
            extract($row);
            $brand = new Brand($BRANDID, $BRANDNAME,$STATUS);
            array_push($listBrands, $brand);
        }
        return new Response(1,"Get all brand success", $listBrands);
    }

    public function getBrandsByID($brandID){
        $sql = "SELECT BRANDID, BRANDNAME, STATUS FROM ".$this->table_name." WHERE BRANDID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$brandID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listBrands = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $brand = new Brand($BRANDID, $BRANDNAME,$STATUS);
            array_push($listBrands, $brand);
        }
        return new Response(1,"Get brand by id success", $listBrands);
    }

    public function insertBrand($brandName){
        $sql = "INSERT INTO ".$this->table_name." (BRANDNAME, STATUS) VALUES(?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$brandName); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert brand success", null);
        } else{
            $response = new Response(0, "Fail to add brand, possibly dupplication", null);
        }
        return $response;
    }

    public function updateBrandByID($brandID,$brandName,$status){
        $sql = "UPDATE ".$this->table_name." SET BRANDNAME=?, STATUS=b? WHERE BRANDID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt ->bindParam(1,$brandName);
        $stmt ->bindParam(2,$status);
        $stmt ->bindParam(3,$brandID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update brand success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>