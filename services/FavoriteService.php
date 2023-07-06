<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/favorite.php';

class FavoriteService
{
    private $connection;
    private $table_name = "TBL_FAVORITE";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getUserFavorite($userID)
    {
        $sql = "SELECT FAVORITEID, ISFAVORITE, USERID, PRODUCTID FROM " . $this->table_name . " WHERE USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listFavorites = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $favorite = new Favorite($FAVORITEID, $ISFAVORITE, $USERID, $PRODUCTID);
            array_push($listFavorites, $favorite);
        }
        return new Response(1, "Get user favorite success", $listFavorites);
    }

    public function updateFavoriteStatus($favoriteID, $userID, $isFavorite)
    {
        $sql = "UPDATE ".$this->table_name." SET ISFAVORITE=b? WHERE FAVORITEID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $isFavorite);
        $stmt->bindParam(2, $favoriteID);
        $stmt->bindParam(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Update favorite status success", null);
        } else {
            $response = new Response(0, "Fail to update favorite status rating, possibly dupplication", null);
        }
        return $response;
    }

    public function insertFavorite($userID, $productID){
        if ($this->checkFavorite($userID, $productID)->response_code == 0) {
            $sql = "INSERT INTO " . $this->table_name . " (ISFAVORITE,USERID,PRODUCTID) VALUES(true,?,?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $userID);
            $stmt->bindParam(2, $productID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $response = new Response(1, "Insert favorite status success", null);
            } else {
                $response = new Response(0, "Fail to insert favorite status rating, possibly dupplication", null);
            }
        } else{
            $response = new Response(0, "Already in database", null);
        }
        return $response;
    }

    public function checkFavorite($userID, $productID)
    {
        $sql = "SELECT FAVORITEID, ISFAVORITE, USERID, PRODUCTID FROM " . $this->table_name . " WHERE USERID=? AND PRODUCTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->bindParam(2, $productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listFavorites = [];
        if ($stmt->rowCount() > 0) {
            return new Response(1, "Favorite found", $listFavorites);
        } else {
            $response = new Response(0, "No favorite found", null);
        }
    }
}
