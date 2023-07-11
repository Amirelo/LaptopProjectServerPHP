<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/userOrder.php';

class UserOrderService{
    private $connection;
    private $table_name= "TBL_USERORDER";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }
    public function getAllUserOrders(){
        $sql = "SELECT USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PAYMENTTYPE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE,ADDRESSID,USERID,COUPONID FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listUserOrders = [];
        while($row = $stmt->fetch()){
            extract($row);
            $userOrder = new UserOrder($USERORDERID,$TOTALPRICE,$ORIGINALPRICE,$NOTE,$STATUS,$RECEIVER,$SHIPPINGFEE,$PAYMENTTYPE,$PENDINGDATE,$PREPAREDATE,$DELIVERYDATE,$ARRIVEDDATE,$ADDRESSID,$USERID,$COUPONID);
            array_push($listUserOrders, $userOrder);
        }
        return new Response(1,"Get all userOrder success", $listUserOrders);
    }

    public function getUserOrderByUserID($userID){
        $sql = "SELECT USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PAYMENTTYPE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE,ADDRESSID,USERID,COUPONID FROM ".$this->table_name." WHERE USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listUserOrders = [];
        if($stmt->rowCount()>0){
            $row = $stmt->fetch();
            extract($row);
            $userOrder = new UserOrder($USERORDERID,$TOTALPRICE,$ORIGINALPRICE,$NOTE,$STATUS,$RECEIVER,$SHIPPINGFEE,$PAYMENTTYPE,$PENDINGDATE,$PREPAREDATE,$DELIVERYDATE,$ARRIVEDDATE,$ADDRESSID,$USERID,$COUPONID);
            array_push($listUserOrders, $userOrder);
        }
        return new Response(1,"Get userOrder by userID success", $listUserOrders);
    }

    public function insertUserOrderInfo($totalPrice,$originalPrice,$note,$receiver,$shippingFee,$paymentType,$addressID,$userID,$couponID){
        $sql = "INSERT INTO ".$this->table_name." (TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PAYMENTTYPE,PENDINGDATE,ADDRESSID,USERID,COUPONID) VALUES(?,?,?,0,?,?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $pendingDate = date('Y-m-d');
        $stmt->bindParam(1,$totalPrice); 
        $stmt->bindParam(2,$originalPrice);
        $stmt->bindParam(3,$note); 
        $stmt->bindParam(4,$receiver);
        $stmt->bindParam(5,$shippingFee);
        $stmt->bindParam(6,$paymentType);
        $stmt->bindParam(7,$pendingDate);
        $stmt->bindParam(8,$addressID);
        $stmt->bindParam(9,$userID);
        $stmt->bindParam(10,$couponID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert userOrder success", null);
        } else{
            $response = new Response(0, "Fail to add userOrder, possibly dupplication", null);
        }
        return $response;
    }

    public function updateUserOrderStatus($userOrderID,$userID, $status,$type){
        $sql = "";
        switch($type){
            case "PREPARE":
                $sql = "UPDATE ".$this->table_name." SET STATUS=?, PREPAREDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            case "DELIVERY":
                $sql = "UPDATE ".$this->table_name." SET STATUS=?, DELIVERYDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            case "ARRIVED":
                $sql = "UPDATE ".$this->table_name." SET STATUS=?, ARRIVEDDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            default:
                return new Response(0,"No type matched",null);
        }
        $date = date('Y-m-d');
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$status); 
        $stmt->bindParam(2,$date);
        $stmt->bindParam(3,$userOrderID);
        $stmt->bindParam(4,$userID); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update userOrder status success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>