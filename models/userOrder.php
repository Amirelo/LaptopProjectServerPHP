<?php 
class UserOrder{
    public $userOrderID;
    public $totalPrice;
    public $originalPrice;
    public $note;
    public $status;
    public $receiver;
    public $shippingFee;
    public $pendingDate;
    public $prepareDate;
    public $deliveryDate;
    public $arrivedDate;
    public $addressID;
    public $userID;
    public $couponID;
    public $cardID;

function __construct($userOrderID,$totalPrice,$originalPrice,$note,$status,$receiver,$shippingFee,$pendingDate,$prepareDate,$deliveryDate,$arrivedDate,$addressID,$userID,$couponID,$cardID)
    {
        $this-> userOrderID = $userOrderID;
        $this-> totalPrice = $totalPrice;
        $this-> originalPrice = $originalPrice;
        $this-> note = $note;
        $this-> status = $status;
        $this-> receiver = $receiver;
        $this-> shippingFee = $shippingFee;
        $this-> pendingDate = $pendingDate;
        $this-> prepareDate = $prepareDate;
        $this-> deliveryDate = $deliveryDate;
        $this-> arrivedDate = $arrivedDate;
        $this-> addressID = $addressID;
        $this-> userID = $userID;
        $this-> couponID = $couponID;
        $this-> cardID = $cardID;
    }
}

?>