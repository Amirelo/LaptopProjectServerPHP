<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/productImage.php';

class ProductImageService{
    private $connection;
    private $table_name= "TBL_PRODUCTIMAGE";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllProductImages(){
        $sql = "SELECT PRODUCTIMAGEID,PRODUCTIMAGELINK,STATUS,PRODUCTID FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProductImages = [];
        while($row = $stmt->fetch()){
            extract($row);
            $productImage = new ProductImage($PRODUCTIMAGEID,$PRODUCTIMAGELINK,$STATUS,$PRODUCTID);
            array_push($listProductImages, $productImage);
        }
        return new Response(1,"Get all productImage success", $listProductImages);
    }

    public function getProductImagesByProductID($productID){
        $sql = "SELECT PRODUCTIMAGEID,PRODUCTIMAGELINK,STATUS,PRODUCTID FROM ".$this->table_name." WHERE PRODUCTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProductImages = [];
        while($row = $stmt->fetch()){
            extract($row);
            $productImage = new ProductImage($PRODUCTIMAGEID,$PRODUCTIMAGELINK,$STATUS,$PRODUCTID);
            array_push($listProductImages, $productImage);
        }
        return new Response(1,"Get productImage by id success", $listProductImages);
    }

    public function insertProductImageInfo($productImageLink,$productID){
        $sql = "INSERT INTO ".$this->table_name." (PRODUCTIMAGELINK,STATUS,PRODUCTID) VALUES(?,true,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productImageLink); 
        $stmt->bindParam(2,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert productImage success", null);
        } else{
            $response = new Response(0, "Fail to add productImage, possibly dupplication", null);
        }
        return $response;
    }

    public function updateProductImageByID($productImageID,$productImageLink,$status,$productID){
        $sql = "UPDATE ".$this->table_name." SET PRODUCTIMAGELINK=?,STATUS=?,PRODUCTID=? WHERE PRODUCTIMAGEID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$productImageLink); 
        $stmt->bindParam(2,$status);
        $stmt->bindParam(3,$productID); 
        $stmt->bindParam(4,$productImageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update productImage success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>