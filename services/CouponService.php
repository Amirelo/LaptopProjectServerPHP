<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/coupon.php';

class CouponService
{
    private $connection;
    private $table_name = "TBL_COUPON";

    public function __construct()
    {
        $this->connection =  (new Database())->getConnect();
    }

    public function insertCoupon($name, $effect, $maxEffectValue, $couponCode, $userID)
    {
        $sql = "INSERT INTO " . $this->table_name . " (NAME,EFFECT,MAXEFFECTVALUE,COUPONCODE,STATUS,USERID) VALUES(?,?,?,?,0,?)";
        $stmt =  $this->connection->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $effect);
        $stmt->bindParam(3, $maxEffectValue);
        $stmt->bindParam(4, $couponCode);
        $stmt->bindParam(5, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Insert coupon successful", null);
        }
        return $response;
    }

    public function insertGlobalCoupon($name, $effect, $maxEffectValue, $couponCode)
    {
        try{
        $sql = "SELECT * FROM TBL_USER";
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $sql = "INSERT INTO " . $this->table_name . " (NAME,EFFECT,MAXEFFECTVALUE,COUPONCODE,STATUS,USERID) VALUES(?,?,?,?,0,?)";
            $stmt2 =  $this->connection->prepare($sql);
            $stmt2->bindParam(1, $name);
            $stmt2->bindParam(2, $effect);
            $stmt2->bindParam(3, $maxEffectValue);
            $stmt2->bindParam(4, $couponCode);
            $stmt2->bindParam(5, $row['userID']);
            echo json_encode($row);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
        }
        $response = new Response(1,"Insert global coupon success", null);
    } catch(Exception $e){
        $response = new Response(0,$e->getMessage(), null);
    }
        return $response;
    }

    public function updateCouponStatus($status, $couponID)
    {
        $sql = "UPDATE " . $this->table_name . " SET status=? WHERE couponID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $couponID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Update coupon status success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }

    public function getCouponsByUserID($userID)
    {
        $sql = "SELECT COUPONID, NAME, EFFECT, MAXEFFECTVALUE, COUPONCODE,STATUS,USERID FROM " . $this->table_name . " WHERE userID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listCoupons = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $coupon = new Coupon($COUPONID, $NAME, $EFFECT, $MAXEFFECTVALUE, $COUPONCODE, $STATUS, $USERID);
            array_push($listCoupons, $coupon);
        }
        return new Response(1, "Get by user id success", $listCoupons);
    }
}
