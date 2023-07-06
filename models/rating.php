<?php 
class Rating{
    public $ratingID;
    public $dateAdded;
    public $rating;
    public $comment;
    public $status;
    public $userID;
    public $productID;

    public function __construct($ratingID,$dateAdded,$rating,$comment,$status,$userID,$productID)
    {
        $this -> ratingID = $ratingID;
        $this -> dateAdded = $dateAdded;
        $this -> rating = $rating;
        $this -> comment = $comment;
        $this -> status = $status;
        $this -> userID = $userID;
        $this -> productID = $productID;

    }
}

?>