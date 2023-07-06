<?php 
class RatingImage{
    public $ratingImageID;
    public $imageLink;
    public $status;
    public $ratingID;

    public function __construct($ratingImageID,$imageLink,$status,$ratingID){
        $this-> ratingImageID = $ratingImageID;
        $this-> imageLink = $imageLink;
        $this-> status = $status;
        $this-> ratingID = $ratingID;
    }
}

?>