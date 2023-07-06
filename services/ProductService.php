<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/product.php';

class ProductService{
    private $connection;
    private $table_name= "TBL_PRODUCT";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllProducts(){
        $sql = "SELECT PRODUCTID,PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProducts = [];
        while($row = $stmt->fetch()){
            extract($row);
            $product = new Product($PRODUCTID, $PRODUCTNAME, $PRODUCTPRICE, $PRODUCTQUANTITY, $RELEASEDDATE, $TOTALRATING, $MODELCODE, $ONSALE, $CURRENTPRICE, $MANUFACTURER, $WARRANTY, $SOLD, $STATUS, $BRANDID, $SCREENID, $OPERATINGSYSTEMID, $PROCESSORID, $MEMORYID, $STORAGEID);
            array_push($listProducts, $product);
        }
        return new Response(1,"Get all product success", $listProducts);
    }

    public function getProductByID($productID){
        $sql = "SELECT PRODUCTID,PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID FROM ".$this->table_name." WHERE PRODUCTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProducts = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $product = new Product($PRODUCTID, $PRODUCTNAME, $PRODUCTPRICE, $PRODUCTQUANTITY, $RELEASEDDATE, $TOTALRATING, $MODELCODE, $ONSALE, $CURRENTPRICE, $MANUFACTURER, $WARRANTY, $SOLD, $STATUS, $BRANDID, $SCREENID, $OPERATINGSYSTEMID, $PROCESSORID, $MEMORYID, $STORAGEID);
            array_push($listProducts, $product);
        }
        return new Response(1,"Get product by id success", $listProducts);
    }

    public function insertProductInfo($productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        $sql = "INSERT INTO ".$this->table_name." (PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productName); 
        $stmt->bindParam(2,$productPrice);
        $stmt->bindParam(3,$productQuantity); 
        $stmt->bindParam(4,$releasedDate);
        $stmt->bindParam(5,$totalRating); 
        $stmt->bindParam(6,$modelCode);
        $stmt->bindParam(7,$onSale); 
        $stmt->bindParam(8,$currentPrice);
        $stmt->bindParam(9,$manufacturer); 
        $stmt->bindParam(10,$warranty);
        $stmt->bindParam(11,$sold); 
        $stmt->bindParam(12,$status);
        $stmt->bindParam(13,$brandID); 
        $stmt->bindParam(14,$screenID);
        $stmt->bindParam(15,$operatingSystemID); 
        $stmt->bindParam(16,$processorID);
        $stmt->bindParam(17,$memoryID); 
        $stmt->bindParam(18,$storageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert product success", null);
        } else{
            $response = new Response(0, "Fail to add product, possibly dupplication", null);
        }
        return $response;
    }
    public function updateProductByID($productID, $productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        $sql = "UPDATE ".$this->table_name." SET PRODUCTNAME=?,PRODUCTPRICE=?,PRODUCTQUANTITY=?,RELEASEDDATE=?,TOTALRATING=?,MODELCODE=?,ONSALE=?,CURRENTPRICE=?,MANUFACTURER=?,WARRANTY=?,SOLD=?,STATUS=b?,BRANDID=?,SCREENID=?,OPERATINGSYSTEMID=?,PROCESSORID=?,MEMORYID=?,STORAGEID=? WHERE PRODUCTID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$productName); 
        $stmt->bindParam(2,$productPrice);
        $stmt->bindParam(3,$productQuantity); 
        $stmt->bindParam(4,$releasedDate);
        $stmt->bindParam(5,$totalRating); 
        $stmt->bindParam(6,$modelCode);
        $stmt->bindParam(7,$onSale); 
        $stmt->bindParam(8,$currentPrice);
        $stmt->bindParam(9,$manufacturer); 
        $stmt->bindParam(10,$warranty);
        $stmt->bindParam(11,$sold); 
        $stmt->bindParam(12,$status);
        $stmt->bindParam(13,$brandID); 
        $stmt->bindParam(14,$screenID);
        $stmt->bindParam(15,$operatingSystemID); 
        $stmt->bindParam(16,$processorID);
        $stmt->bindParam(17,$memoryID); 
        $stmt->bindParam(18,$storageID);
        $stmt->bindParam(19,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update product success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>