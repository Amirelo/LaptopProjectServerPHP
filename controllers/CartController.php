<?php 

include_once '../../services/CartService.php';

class CartController{
    private $storageService;
    public function __construct(){
        $this->storageService = new CartService();
    }

    public function getAllCarts(){
        return $this->storageService->getAllCarts();
    }

    public function getCartsByUserID($userID){
        return $this->storageService->getCartsByUserID($userID);
    }

    public function insertCartInfo($itemQuantity,$userID,$productID){
        return $this->storageService->insertCartInfo($itemQuantity,$userID,$productID);
    }

    public function updateCartQuantityByID($cartID,$itemQuantity){
        return $this->storageService->updateCartQuantityByID($cartID,$itemQuantity);
    }

    public function deleteCartByID($cartID){
        return $this->storageService->deleteCartByID($cartID);
    }

}

?>