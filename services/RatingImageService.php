<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/ratingImage.php';

class RatingImageService{
    private $connection;
    private $table_name= "TBL_RATINGIMAGE";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllRatingImages(){
        $sql = "SELECT RATINGIMAGEID,IMAGELINK,STATUS,RATINGID FROM ".$this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listRatingImages = [];
        while($row = $stmt->fetch()){
            extract($row);
            $ratingImage = new RatingImage($RATINGIMAGEID,$IMAGELINK,$STATUS,$RATINGID);
            array_push($listRatingImages, $ratingImage);
        }
        return new Response(1,"Get all ratingImage success", $listRatingImages);
    }

    public function getRatingImagesByRatingID($ratingID){
        $sql = "SELECT RATINGIMAGEID,IMAGELINK,STATUS,RATINGID FROM ".$this->table_name." WHERE RATINGID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$ratingID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listRatingImages = [];
        while($row = $stmt->fetch()){
            extract($row);
            $ratingImage = new RatingImage($RATINGIMAGEID,$IMAGELINK,$STATUS,$RATINGID);
            array_push($listRatingImages, $ratingImage);
        }
        return new Response(1,"Get ratingImage by id success", $listRatingImages);
    }

    public function insertRatingImageInfo($imageLink,$ratingID){
        $sql = "INSERT INTO ".$this->table_name." (IMAGELINK,STATUS,RATINGID) VALUES(?,true,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$imageLink); 
        $stmt->bindParam(2,$ratingID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Insert ratingImage success", null);
        } else{
            $response = new Response(0, "Fail to add ratingImage, possibly dupplication", null);
        }
        return $response;
    }

    public function updateRatingImageByID($ratingImageID,$imageLink,$status,$ratingID){
        $sql = "UPDATE ".$this->table_name." SET IMAGELINK=?,STATUS=?,RATINGID=? WHERE RATINGIMAGEID=?";
        $stmt= $this->connection->prepare($sql);
        $stmt->bindParam(1,$imageLink); 
        $stmt->bindParam(2,$status);
        $stmt->bindParam(3,$ratingID); 
        $stmt->bindParam(4,$ratingImageID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if($stmt->rowCount()>0){
            $response = new Response(1, "Update ratingImage success", null);
        } else{
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}




?>