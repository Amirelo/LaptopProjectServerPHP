<?php 
class Cart{
    public $cartID;
    public $itemQuantity;
    public $userID;
    public $productID;
    public $productName;
    public $productPrice;
    PUBLIC $productImageLink;
    public function __construct($cartID,$itemQuantity,$userID,$productID,$productName,$productPrice,$productImageLink)
    {
        $this-> cartID = $cartID;
        $this-> itemQuantity = $itemQuantity;
        $this-> userID = $userID;
        $this-> productID = $productID;
        $this -> productName =$productName;
        $this -> productPrice =$productPrice;
        $this -> productImageLink = $productImageLink;
    }
}

?>