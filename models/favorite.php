<?php 
class Favorite{
    public $favoriteID;
    public $isFavorite;
    public $userID;
    public $productID;

    public function __construct($favoriteID,$isFavorite,$userID,$productID)
    {
        $this -> favoriteID = $favoriteID;
        $this -> isFavorite = $isFavorite;
        $this -> userID = $userID;
        $this -> productID = $productID;
    }
}

?>