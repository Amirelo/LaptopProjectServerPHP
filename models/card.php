<?php 

class Card{
    public $cardID;
    public $type;
    public $cardNumber;
    public $cardHolder;
    public $expiryMonth;
    public $expiryYear;
    public $status;
    public $userID;
    
    public function __construct($cardID,$type,$cardNumber,$cardHolder,$expiryMonth,$expiryYear,$status,$userID)
    {
        $this -> cardID =$cardID;
        $this -> type =$type;
        $this -> cardNumber =$cardNumber;
        $this -> cardHolder =$cardHolder;
        $this -> expiryMonth =$expiryMonth;
        $this -> expiryYear =$expiryYear;
        $this -> status =$status;
        $this -> userID =$userID;
    }
}

?>