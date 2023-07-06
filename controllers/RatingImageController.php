<?php 

include_once '../../services/RatingImageService.php';

class RatingImageController{
    private $ratingImageService;
    public function __construct(){
        $this->ratingImageService = new RatingImageService();
    }

    public function getAllRatingImages(){
        return $this->ratingImageService->getAllRatingImages();
    }

    public function getRatingImagesByRatingID($ratingID){
        return $this->ratingImageService->getRatingImagesByRatingID($ratingID);
    }

    public function insertRatingImageInfo($ratingImageLink,$ratingID){
        return $this->ratingImageService->insertRatingImageInfo($ratingImageLink,$ratingID);
    }

    public function updateRatingImageByID($ratingImageID,$ratingImageLink,$status,$ratingID){
        return $this->ratingImageService->updateRatingImageByID($ratingImageID,$ratingImageLink,$status,$ratingID);
    }
}

?>