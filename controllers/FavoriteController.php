<?php 
include_once "../../services/FavoriteService.php";

class FavoriteController{
    private $favoriteService;

    public function __construct()
    {
        $this->favoriteService = new FavoriteService();
    }

    public function getUserFavorite($userID){
        return $this->favoriteService->getUserFavorite($userID);
    }

    public function updateFavoriteStatus($favoriteID, $userID,$isFavorite){
        return $this->favoriteService->updateFavoriteStatus($favoriteID, $userID,$isFavorite);
    }

    public function insertFavorite($userID, $productID){
        return $this->favoriteService->insertFavorite($userID, $productID);
    }

    public function checkFavorite($userID,$productID) {
        return $this->favoriteService->checkFavorite($userID,$productID);
    }

}

?>