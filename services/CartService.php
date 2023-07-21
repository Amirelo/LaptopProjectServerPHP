<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/cart.php';

class CartService
{
    private $connection;
    private $table_name = "TBL_CART";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllCarts()
    {
        $sql = "SELECT CARTID,ITEMQUANTITY,C.USERID,C.PRODUCTID, P.PRODUCTNAME,P.CURRENTPRICE FROM " . $this->table_name . " C LEFT JOIN TBL_PRODUCT P ON C.PRODUCTID=P.PRODUCTID";
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listCarts = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $cart = new Cart($CARTID, $ITEMQUANTITY, $USERID, $PRODUCTID, $PRODUCTNAME, $CURRENTPRICE, null);
            array_push($listCarts, $cart);
        }
        return new Response(1, "Get all cart success", $listCarts);
    }

    public function getCartsByUsername($username)
    {
        $sql = "SELECT CARTID,ITEMQUANTITY,C.USERID,C.PRODUCTID, P.PRODUCTNAME,P.CURRENTPRICE,U.USERNAME, PI.PRODUCTIMAGELINK FROM " . $this->table_name .
            " C LEFT JOIN TBL_USER U ON C.USERID = U.USERID "
            . "LEFT JOIN TBL_PRODUCT P ON C.PRODUCTID=P.PRODUCTID "
            . "LEFT JOIN TBL_PRODUCTIMAGE PI ON PI.PRODUCTID = P.PRODUCTID WHERE USERNAME=? AND PI.STATUS=1";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $listCarts = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $cart = new Cart($CARTID, $ITEMQUANTITY, $USERID, $PRODUCTID, $PRODUCTNAME, $CURRENTPRICE, $PRODUCTIMAGELINK);
            array_push($listCarts, $cart);
        }
        return new Response(1, "Get cart by username success", $listCarts);
    }

    public function getCartsByEmail($email)
    {
        $sql = "SELECT CARTID,ITEMQUANTITY,C.USERID,C.PRODUCTID, P.PRODUCTNAME,P.CURRENTPRICE,U.USERNAME, PI.PRODUCTIMAGELINK FROM " . $this->table_name .
            " C LEFT JOIN TBL_USER U ON C.USERID = U.USERID "
            . "LEFT JOIN TBL_PRODUCT P ON C.PRODUCTID=P.PRODUCTID "
            . "LEFT JOIN TBL_PRODUCTIMAGE PI ON PI.PRODUCTID = P.PRODUCTID WHERE EMAIL=? AND PI.STATUS=1";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $listCarts = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $cart = new Cart($CARTID, $ITEMQUANTITY, $USERID, $PRODUCTID, $PRODUCTNAME, $CURRENTPRICE, $PRODUCTIMAGELINK);
            array_push($listCarts, $cart);
        }
        return new Response(1, "Get cart by email success", $listCarts);
    }

    public function checkCartDuplicate($userID, $productID)
    {
        $sql = "SELECT ITEMQUANTITY,USERID,PRODUCTID FROM " . $this->table_name . " WHERE USERID=? AND PRODUCTID=?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->bindParam(2, $productID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return new Response(1, "Duplicate found", null);
        } else {
            return new Response(0, "No duplication", null);
        }
    }

    public function insertCartInfo($itemQuantity, $userID, $productID)
    {
        if ($this->checkCartDuplicate($userID, $productID)->response_code == 0) {
            $sql = "INSERT INTO " . $this->table_name . " (ITEMQUANTITY,USERID,PRODUCTID) VALUES(?,?,?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(1, $itemQuantity);
            $stmt->bindParam(2, $userID);
            $stmt->bindParam(3, $productID);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $response = new Response(1, "Insert cart success", null);
            } else {
                $response = new Response(0, "Fail to add cart, possibly dupplication", null);
            }
        } else {
            $response = new Response(0, "Duplicate entry", null);
        }
        return $response;
    }

    public function updateCartQuantityByID($cartID, $itemQuantity)
    {
        $sql = "UPDATE " . $this->table_name . " SET itemQuantity=(itemQuantity+?) WHERE CARTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $itemQuantity);
        $stmt->bindParam(2, $cartID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Update cart success", null);
        } else {
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }

    public function deleteCartByID($cartID)
    {
        $sql = "DELETE FROM " . $this->table_name . " WHERE CARTID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $cartID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Delete cart success", null);
        } else {
            $response = new Response(0, "No row matched id", null);
        }
        return $response;
    }
}
