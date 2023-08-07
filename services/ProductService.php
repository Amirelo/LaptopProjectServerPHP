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
        $sql = "SELECT P.PRODUCTID,P.PRODUCTNAME,P.PRODUCTPRICE,P.PRODUCTQUANTITY,P.RELEASEDDATE,P.TOTALRATING,P.MODELCODE,P.ONSALE,P.CURRENTPRICE,P.MANUFACTURER,P.WARRANTY,P.SOLD,P.LENGTH,P.WIDTH,P.HEIGHT,P.WEIGHT,P.STATUS,P.BRANDID,P.SCREENID,P.OPERATINGSYSTEMID,P.PROCESSORID,P.MEMORYID,P.STORAGEID, I.PRODUCTIMAGELINK FROM ".$this->table_name." P LEFT JOIN TBL_PRODUCTIMAGE I ON P.PRODUCTID = (SELECT I.PRODUCTID WHERE I.STATUS=1)";
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProducts = [];
        while($row = $stmt->fetch()){
            extract($row);
            $product = new Product($PRODUCTID, $PRODUCTNAME, $PRODUCTPRICE, $PRODUCTQUANTITY, $RELEASEDDATE, $TOTALRATING, $MODELCODE, $ONSALE, $CURRENTPRICE, $MANUFACTURER, $WARRANTY, $SOLD,$LENGTH,$WIDTH,$HEIGHT,$WEIGHT, $STATUS, $BRANDID, $SCREENID, $OPERATINGSYSTEMID, $PROCESSORID, $MEMORYID, $STORAGEID, $PRODUCTIMAGELINK);
            array_push($listProducts, $product);
        }
        return new Response(1,"Get all product success", $listProducts);
    }
    
    public function getProductByID($productID){
        $sql = "SELECT P.PRODUCTID,PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,LENGTH,WIDTH,HEIGHT,WEIGHT,P.STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID,PRODUCTIMAGELINK FROM ".$this->table_name." P LEFT JOIN TBL_PRODUCTIMAGE I ON P.PRODUCTID = I.PRODUCTID WHERE I.STATUS = 1 AND P.PRODUCTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listProducts = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $product = new Product($PRODUCTID, $PRODUCTNAME, $PRODUCTPRICE, $PRODUCTQUANTITY, $RELEASEDDATE, $TOTALRATING, $MODELCODE, $ONSALE, $CURRENTPRICE, $MANUFACTURER, $WARRANTY, $SOLD,$LENGTH,$WIDTH,$HEIGHT,$WEIGHT, $STATUS, $BRANDID, $SCREENID, $OPERATINGSYSTEMID, $PROCESSORID, $MEMORYID, $STORAGEID, $PRODUCTIMAGELINK);
            array_push($listProducts, $product);
        }
        return new Response(1,"Get product by id success", $listProducts);
    }

   


    public function insertProductInfo($productName, $productPrice, $productQuantity, $releasedDate, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $length, $width, $height, $weight, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        $sql = "INSERT INTO ".$this->table_name." (PRODUCTNAME,PRODUCTPRICE,PRODUCTQUANTITY,RELEASEDDATE,TOTALRATING,MODELCODE,ONSALE,CURRENTPRICE,MANUFACTURER,WARRANTY,SOLD,LENGTH,WIDTH,HEIGHT,WEIGHT,STATUS,BRANDID,SCREENID,OPERATINGSYSTEMID,PROCESSORID,MEMORYID,STORAGEID) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,b?,?,?,?,?,?,?)";
        $totalRating =0;
        $status = true;
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productName); 
        $stmt->bindParam(2,$productPrice);
        $stmt->bindParam(3,$productQuantity); 
        $stmt->bindParam(4,$releasedDate);
        $stmt->bindParam(5, $totalRating); 
        $stmt->bindParam(6,$modelCode);
        $stmt->bindParam(7,$onSale); 
        $stmt->bindParam(8,$currentPrice);
        $stmt->bindParam(9,$manufacturer); 
        $stmt->bindParam(10,$warranty);
        $stmt->bindParam(11,$sold);
        $stmt->bindParam(12,$length);
        $stmt->bindParam(13,$width);
        $stmt->bindParam(14,$height);
        $stmt->bindParam(15,$weight); 
        $stmt->bindParam(16, $status);
        $stmt->bindParam(17,$brandID); 
        $stmt->bindParam(18,$screenID);
        $stmt->bindParam(19,$operatingSystemID); 
        $stmt->bindParam(20,$processorID);
        $stmt->bindParam(21,$memoryID); 
        $stmt->bindParam(22,$storageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert product success", null);
        } else{
            $response = new Response(0, "Fail to add product, possibly dupplication", null);
        }
        return $response;
    }
    public function updateProductByID($productID, $productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $length, $width, $height, $weight, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        $sql = "UPDATE ".$this->table_name." SET PRODUCTNAME=?,PRODUCTPRICE=?,PRODUCTQUANTITY=?,RELEASEDDATE=?,TOTALRATING=?,MODELCODE=?,ONSALE=?,CURRENTPRICE=?,MANUFACTURER=?,WARRANTY=?,SOLD=?,LENGTH=?,WIDTH=?,HEIGHT=?,WEIGHT=?,STATUS=b?,BRANDID=?,SCREENID=?,OPERATINGSYSTEMID=?,PROCESSORID=?,MEMORYID=?,STORAGEID=? WHERE PRODUCTID=?";
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
        $stmt->bindParam(12,$length);
        $stmt->bindParam(13,$width);
        $stmt->bindParam(14,$height);
        $stmt->bindParam(15,$weight); 
        $stmt->bindParam(16,$status);
        $stmt->bindParam(17,$brandID); 
        $stmt->bindParam(18,$screenID);
        $stmt->bindParam(19,$operatingSystemID); 
        $stmt->bindParam(20,$processorID);
        $stmt->bindParam(21,$memoryID); 
        $stmt->bindParam(22,$storageID);
        $stmt->bindParam(23,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update product success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }

    public function updateProductStatus($productID,$status){
        $sql = "UPDATE ".$this->table_name." SET STATUS=b? WHERE PRODUCTID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$status); 
        $stmt->bindParam(2,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update product status success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}






?>