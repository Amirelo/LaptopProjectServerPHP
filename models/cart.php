<?php 
class Cart{
    public $cartID;
    public $itemQuantity;
    public $userID;
    public $productID;
    public function __construct($cartID,$itemQuantity,$userID,$productID)
    {
        $this-> cartID = $cartID;
        $this-> itemQuantity = $itemQuantity;
        $this-> userID = $userID;
        $this-> productID = $productID;
    }
}

?>