<?php 
include_once "../../services/OrderDetailService.php";

class OrderDetailController{
    private $orderDetailService;

    public function __construct()
    {
        $this->orderDetailService = new OrderDetailService();
    }

    public function getUserOrderDetail($userOrderID){
        return $this->orderDetailService->getUserOrderDetail($userOrderID);
    }

    public function insertOrderDetail($productQuantity,$userOrderID,$productID,$cartID){
        return $this->orderDetailService->insertOrderDetail($productQuantity,$userOrderID,$productID,$cartID);
    }

}

?>