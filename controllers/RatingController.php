<?php 
include_once "../../services/RatingService.php";

class RatingController{
    private $ratingService;

    public function __construct()
    {
        $this->ratingService = new RatingService();
    }

    public function getAllRatings(){
        return $this->ratingService->getAllRatings();
    }

    public function getRatingsByUserID($userID){
        return $this->ratingService->getRatingsByUserID($userID);
    }

    public function getProductRatings($productID){
        return $this->ratingService->getProductRatings($productID);
    }

    public function insertRating($rating,$comment,$userID,$productID){
        return $this->ratingService->insertRating($rating,$comment,$userID,$productID);
    }

    public function updateUserRating($ratingID,$rating,$comment,$status,$userID,$productID){
        return $this->ratingService->updateUserRating($ratingID,$rating,$comment,$status,$userID,$productID);
    }

    public function updateUserRatingStatus($ratingID,$status){
        return $this->ratingService->updateUserRatingStatus($ratingID,$status);
    }
}

?>