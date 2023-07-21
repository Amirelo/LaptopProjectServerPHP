<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/orderDetail.php';

class OrderDetailService
{
    private $connection;
    private $table_name = "TBL_ORDERDETAIL";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getUserOrderDetail($userOrderID)
    {
        $sql = "SELECT ORDERDETAILID,PRODUCTQUANTITY,USERORDERID,PRODUCTID FROM " . $this->table_name . " WHERE USERORDERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userOrderID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listOrderDetails = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $orderDetail = new OrderDetail($ORDERDETAILID, $PRODUCTQUANTITY, $USERORDERID, $PRODUCTID);
            array_push($listOrderDetails, $orderDetail);
        }
        return new Response(1, "Get all orderDetail success", $listOrderDetails);
    }

    public function insertOrderDetail($productQuantity, $userOrderID, $productID)
    {
        $sql = "INSERT INTO " . $this->table_name . " (PRODUCTQUANTITY,USERORDERID,PRODUCTID) VALUES(?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $productQuantity);
        $stmt->bindParam(2, $userOrderID);
        $stmt->bindParam(3, $productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $sql = "UPDATE TBL_PRODUCT SET PRODUCTQUANTITY=(PRODUCTQUANTITY-?) WHERE PRODUCTID=?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $productQuantity);
            $stmt->bindParam(2, $productID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $response = new Response(1, "Insert orderDetail success", null);
            }
            
        } else {
            $response = new Response(0, "Fail to add orderDetail, possibly dupplication", null);
        }
        return $response;
    }

    // Just in case
    public function updateOrderDetailQuantityByID($orderDetailID, $productQuantity)
    {
        $sql = "UPDATE " . $this->table_name . " SET itemQuantity=(itemQuantity+?) WHERE ORDERDETAILID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $itemQuantity);
        $stmt->bindParam(2, $orderDetailID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Update orderDetail success", null);
        } else {
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}
