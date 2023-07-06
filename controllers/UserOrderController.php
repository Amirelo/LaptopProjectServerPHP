<?php 

include_once '../../services/UserOrderService.php';

class UserOrderController{
    private $storageService;
    public function __construct(){
        $this->storageService = new UserOrderService();
    }

    public function getAllUserOrders(){
        return $this->storageService->getAllUserOrders();
    }

    public function getUserOrderByUserID($userID){
        return $this->storageService->getUserOrderByUserID($userID);
    }

    public function insertUserOrderInfo($totalPrice,$originalPrice,$note,$receiver,$shippingFee,$paymentType,$addressID,$userID,$couponID){
        return $this->storageService->insertUserOrderInfo($totalPrice,$originalPrice,$note,$receiver,$shippingFee,$paymentType,$addressID,$userID,$couponID);
    }

    public function updateUserOrderStatus($userOrderID,$userID, $status,$type){
        return $this->storageService->updateUserOrderStatus($userOrderID,$userID, $status,$type);
    }


}

?>