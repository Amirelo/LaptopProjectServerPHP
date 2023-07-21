<?php 
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/card.php';
class CardService{
    private $connection;
    private $table_name = "TBL_CARD";

    public function __construct()
    {
        $this ->connection = (new Database())->getConnect();
    }

    public function getCardByUserID($userID){
        try{
        $sql = "SELECT CARDID,TYPE,CARDNUMBER,CARDHOLDER,EXPIRYMONTH,EXPIRYYEAR,STATUS,USERID FROM ".$this->table_name." WHERE USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$userID);
        $stmt ->setFetchMode(PDO::FETCH_ASSOC);
        $stmt -> execute();
        $listCards = [];
        while($row = $stmt->fetch()){
            extract($row);
            $card =  new Card($CARDID,$TYPE,$CARDNUMBER,$CARDHOLDER,$EXPIRYMONTH,$EXPIRYYEAR,$STATUS,$USERID);
            array_push($listCards, $card);
        }
        return new Response(1,"Get card by userid success", $listCards);
    } catch(Exception $e){
        return new Response(0,$e->getMessage(), null);
    }
    }
}
?>