<?php 
include_once "../../dbconfigs/dbconfig.php";
include_once "../../models/rating.php";

class RatingService{
    private $connection;
    private $table_name = "TBL_RATING";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();    
    }

    public function getAllRatings(){
        $sql = "SELECT RATINGID,DATEADDED,RATING,COMMENT,STATUS, USERID, PRODUCTID FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listRatings = [];
        while($row = $stmt->fetch()){
            extract($row);
            $rating = new Rating($RATINGID,$DATEADDED,$RATING,$COMMENT, $STATUS,$USERID,$PRODUCTID);
            array_push($listRatings, $rating);
        }
        return new Response(1,"Get all rating success", $listRatings);
    }

    public function getRatingsByUserID($userID){
        $sql = "SELECT RATINGID,DATEADDED,RATING,COMMENT, STATUS, USERID, PRODUCTID FROM ".$this->table_name." WHERE USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listRatings = [];
        while($row = $stmt->fetch()){
            extract($row);
            $rating = new Rating($RATINGID,$DATEADDED,$RATING,$COMMENT,$STATUS,$USERID,$PRODUCTID);
            array_push($listRatings, $rating);
        }
        return new Response(1,"Get user rating success", $listRatings);
    }

    public function getProductRatings($productID){
        $sql = "SELECT RATINGID,DATEADDED,RATING,COMMENT, STATUS, USERID, PRODUCTID FROM ".$this->table_name." WHERE PRODUCTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listRatings = [];
        while($row = $stmt->fetch()){
            extract($row);
            $rating = new Rating($RATINGID,$DATEADDED,$RATING,$COMMENT,$STATUS,$USERID,$PRODUCTID);
            array_push($listRatings, $rating);
        }
        return new Response(1,"Get product rating success", $listRatings);
    }

    public function insertRating($rating,$comment,$userID,$productID){
        $sql = "INSERT INTO ".$this->table_name." (DATEADDED,RATING,COMMENT, STATUS, USERID, PRODUCTID) VALUES(?,?,?,true,?,?)";
        $stmt = $this->connection->prepare($sql);
        $addedDate = date('Y-m-d');
        $stmt->bindParam(1, $addedDate); 
        $stmt->bindParam(2,$rating);
        $stmt->bindParam(3,$comment); 
        $stmt->bindParam(4,$userID);
        $stmt->bindParam(5,$productID); 
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert user rating success", null);
        } else{
            $response = new Response(0, "Fail to add user rating, possibly dupplication", null);
        }
        return $response;
    }

    public function updateUserRating($ratingID,$rating,$comment,$status,$userID,$productID){
        $sql = "UPDATE ".$this->table_name." SET DATEADDED=?,RATING=?,COMMENT=?, STATUS=b?, USERID=?, PRODUCTID=? WHERE RATINGID=?";
        $stmt = $this->connection->prepare($sql);
        $addedDate = date('Y-m-d');
        $stmt->bindParam(1, $addedDate); 
        $stmt->bindParam(2,$rating);
        $stmt->bindParam(3,$comment); 
        $stmt->bindParam(4,$status);
        $stmt->bindParam(5,$userID);
        $stmt->bindParam(6,$productID); 
        $stmt->bindParam(7,$ratingID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update user rating success", null);
        } else{
            $response = new Response(0, "Fail to update user rating, possibly dupplication", null);
        }
        return $response;
    }

    public function updateUserRatingStatus($ratingID,$status){
        $sql = "UPDATE ".$this->table_name." SET STATUS=b? WHERE RATINGID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$status); 
        $stmt->bindParam(2,$ratingID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update user rating status success", null);
        } else{
            $response = new Response(0, "Fail to update user rating status, possibly dupplication", null);
        }
        return $response;
    }
    
}


?>