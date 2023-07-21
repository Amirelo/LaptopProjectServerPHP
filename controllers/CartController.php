<?php 

include_once '../../services/CartService.php';

class CartController{
    private $cartService;
    public function __construct(){
        $this->cartService = new CartService();
    }

    public function getAllCarts(){
        return $this->cartService->getAllCarts();
    }

    public function getCartsByUsername($username){
        return $this->cartService->getCartsByUsername($username);
    }

    public function insertCartInfo($itemQuantity,$userID,$productID){
        return $this->cartService->insertCartInfo($itemQuantity,$userID,$productID);
    }

    public function updateCartQuantityByID($cartID,$itemQuantity){
        return $this->cartService->updateCartQuantityByID($cartID,$itemQuantity);
    }

    public function deleteCartByID($cartID){
        return $this->cartService->deleteCartByID($cartID);
    }

    public function getCartsByEmail($email){
        return $this->cartService->getCartsByEmail($email);
    }
    
}

?>