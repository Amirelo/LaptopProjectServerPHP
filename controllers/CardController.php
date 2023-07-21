<?php 
include_once '../../services/CardService.php';
class CardController {
    private $cardService;

    public function __construct()
    {
        $this->cardService = (new CardService());
    }

    public function getCardsByUserID($userID){
        return $this -> cardService ->getCardByUserID($userID);
    }

}

?>