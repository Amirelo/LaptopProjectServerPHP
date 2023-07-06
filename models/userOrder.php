<?php 
class UserOrder{
    public $totalPrice;
    public $originalPrice;
    public $note;
    public $status;
    public $receiver;
    public $shippingFee;
    public $paymentType;
    public $pendingDate;
    public $prepareDate;
    public $deliveryDate;
    public $arrivedDate;
    public $addressID;
    public $userID;
    public $couponID;


function __construct($totalPrice,$originalPrice,$note,$status,$receiver,$shippingFee,$paymentType,$pendingDate,$prepareDate,$deliveryDate,$arrivedDate,$addressID,$userID,$couponID)
    {
        $this-> totalPrice = $totalPrice;
        $this-> originalPrice = $originalPrice;
        $this-> note = $note;
        $this-> status = $status;
        $this-> receiver = $receiver;
        $this-> shippingFee = $shippingFee;
        $this-> paymentType = $paymentType;
        $this-> pendingDate = $pendingDate;
        $this-> prepareDate = $prepareDate;
        $this-> deliveryDate = $deliveryDate;
        $this-> arrivedDate = $arrivedDate;
        $this-> addressID = $addressID;
        $this-> userID = $userID;
        $this-> couponID = $couponID;
    }
}

?>