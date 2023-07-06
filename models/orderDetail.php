<?php 
class OrderDetail{
    public $orderDetailID;
    public $productQuantity;
    public $userOrderID;
    public $productID;

    public function __construct($orderDetailID,$productQuantity,$userOrderID,$productID)
    {
        $this -> orderDetailID = $orderDetailID;
        $this -> productQuantity = $productQuantity;
        $this -> userOrderID = $userOrderID;
        $this -> productID = $productID;
    }
}


?>