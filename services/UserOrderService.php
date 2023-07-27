<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/userOrder.php';

class UserOrderService
{
    private $connection;
    private $table_name = "TBL_USERORDER";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }
    public function getAllUserOrders()
    {
        $sql = "SELECT USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE,ADDRESSID,USERID,COUPONID,CARDID FROM " . $this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listUserOrders = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $userOrder = new UserOrder($USERORDERID, $TOTALPRICE, $ORIGINALPRICE, $NOTE, $STATUS, $RECEIVER, $SHIPPINGFEE, $PENDINGDATE, $PREPAREDATE, $DELIVERYDATE, $ARRIVEDDATE, $ADDRESSID, $USERID, $COUPONID, $CARDID);
            array_push($listUserOrders, $userOrder);
        }
        return new Response(1, "Get all userOrder success", $listUserOrders);
    }

    public function getUserOrderByUserID($userID)
    {
        $sql = "SELECT USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PENDINGDATE,PREPAREDATE,DELIVERYDATE,ARRIVEDDATE,ADDRESSID,USERID,COUPONID,CARDID FROM " . $this->table_name . " WHERE USERID=? ORDER BY USERORDERID DESC";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listUserOrders = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $userOrder = new UserOrder($USERORDERID, $TOTALPRICE, $ORIGINALPRICE, $NOTE, $STATUS, $RECEIVER, $SHIPPINGFEE, $PENDINGDATE, $PREPAREDATE, $DELIVERYDATE, $ARRIVEDDATE, $ADDRESSID, $USERID, $COUPONID, $CARDID);
            array_push($listUserOrders, $userOrder);
        }
        return new Response(1, "Get userOrder by userID success", $listUserOrders);
    }

    public function insertUserOrderInfo($totalPrice, $originalPrice, $note, $receiver, $shippingFee, $addressID, $userID, $cardID)
    {
        $sql = "INSERT INTO " . $this->table_name . " (TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PENDINGDATE,ADDRESSID,USERID,COUPONID,CARDID) VALUES(?,?,?,1,?,?,?,?,?,null,?)";
        $stmt = $this->connection->prepare($sql);
        $pendingDate = date('Y-m-d');
        $stmt->bindParam(1, $totalPrice);
        $stmt->bindParam(2, $originalPrice);
        $stmt->bindParam(3, $note);
        $stmt->bindParam(4, $receiver);
        $stmt->bindParam(5, $shippingFee);
        $stmt->bindParam(6, $pendingDate);
        $stmt->bindParam(7, $addressID);
        $stmt->bindParam(8, $userID);
        $stmt->bindParam(9, $cardID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $sql2 = "SELECT USERORDERID,TOTALPRICE,ORIGINALPRICE,NOTE,STATUS,RECEIVER,SHIPPINGFEE,PENDINGDATE,ADDRESSID,USERID,COUPONID,CARDID FROM " . $this->table_name . " WHERE USERID=? ORDER BY USERORDERID DESC";
            $stmt2 = $this->connection->prepare($sql2);
            $stmt2->bindParam(1, $userID);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();

            $row = $stmt2->fetch();
            extract($row);
            $userOrder = new UserOrder($USERORDERID, $TOTALPRICE, $ORIGINALPRICE, $NOTE, $STATUS, $RECEIVER, $SHIPPINGFEE, $PENDINGDATE, null, null, null, $ADDRESSID, $USERID, $COUPONID, $CARDID);
            $response = new Response(1, "Insert userOrder success", $userOrder);
        } else {
            $response = new Response(0, "Fail to add userOrder, possibly dupplication", null);
        }
        return $response;
    }

    public function updateUserOrderStatus($userOrderID, $userID, $status, $type)
    {
        $sql = "";
        switch ($type) {
            case "PACKING":
                $sql = "UPDATE " . $this->table_name . " SET STATUS=2, PREPAREDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            case "DELIVERING":
                $sql = "UPDATE " . $this->table_name . " SET STATUS=3, DELIVERYDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            case "COMPLETED":
                $sql = "UPDATE " . $this->table_name . " SET STATUS=4, ARRIVEDDATE=? WHERE USERORDERID=? AND USERID=?";
                break;
            default:
                $sql = "UPDATE " . $this->table_name . " SET STATUS=? WHERE USERORDERID=? AND USERID=?";
        }
        if ($type != "PACKING" && $type != "DELIVERING" && $type != "COMPLETED") {
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $status);
            $stmt->bindParam(2, $userOrderID);
            $stmt->bindParam(3, $userID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $response = new Response(1, "Update userOrder status success", null);
            } else {
                $response = new Response(0, "No row matched id", null);
            }
        } else {
            $date = date('Y-m-d');
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $date);
            $stmt->bindParam(2, $userOrderID);
            $stmt->bindParam(3, $userID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $response = new Response(1, "Update userOrder status success", null);
            } else {
                $response = new Response(0, "No row matched id", null);
            }
        }
        return $response;
    }
}
