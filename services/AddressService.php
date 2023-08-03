<?php
include_once '../../dbconfigs/dbconfig.php';
include_once '../../models/address.php';

class AddressService
{
    private $connection;
    private $table_name = "TBL_ADDRESS";

    public function __construct()
    {
        $this->connection = (new Database())->getConnect();
    }

    public function getAllAddresses()
    {
        $sql = "SELECT addressID, addressName, ward, district, city,status,userID FROM " . $this->table_name;
        $stmt = $this->connection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listAddresses = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $address = new Address($addressID, $addressName, $ward, $district, $city, $status, $userID);
            array_push($listAddresses, $address);
        }
        return new Response(1, "Get success", $listAddresses);
    }

    public function getAddressesByUserID($userID)
    {
        $sql = "SELECT addressID, addressName, ward, district, city,status,userID FROM " . $this->table_name . " WHERE userID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listAddresses = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $address = new Address($addressID, $addressName, $ward, $district, $city, $status, $userID);
            array_push($listAddresses, $address);
        }
        return new Response(1, "Get success", $listAddresses);
    }

    public function getAddressesByUsername($username)
    {
        $sql = "SELECT addressID, addressName, ward, district, city,status, TBL_ADDRESS.userID FROM " . $this->table_name . " LEFT JOIN TBL_USER ON TBL_ADDRESS.USERID=TBL_USER.USERID WHERE username=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $username);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listAddresses = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $address = new Address($addressID, $addressName, $ward, $district, $city, $status, $userID);
            array_push($listAddresses, $address);
        }
        return new Response(1, "Get success", $listAddresses);
    }

    public function getAddressesByEmail($email)
    {
        $sql = "SELECT addressID, addressName, ward, district, city,status, TBL_ADDRESS.userID FROM " . $this->table_name . " LEFT JOIN TBL_USER ON TBL_ADDRESS.USERID=TBL_USER.USERID WHERE EMAIL=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listAddresses = [];
        while ($row = $stmt->fetch()) {
            extract($row);
            $address = new Address($addressID, $addressName, $ward, $district, $city, $status, $userID);
            array_push($listAddresses, $address);
        }
        return new Response(1, "Get success", $listAddresses);
    }

    /* public function getAddressesByUserOrderID($userOrderID){
        $sql = "SELECT addressID, addressName, ward, district, city,status, TBL_ADDRESS.userID FROM ".$this->table_name." LEFT JOIN TBL_USER ON TBL_ADDRESS.USERID=TBL_USER.USERID WHERE USERORDERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(1,$username);
        $stmt-> setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $listAddresses = [];
        while($row = $stmt->fetch()){
            extract($row);
            $address = new Address($addressID, $addressName, $ward, $district, $city,$status,$userID);
            array_push($listAddresses,$address);
        }
        return new Response(1,"Get success", $listAddresses);
    } */

    public function insertAddress($addressName, $ward, $district, $city, $status, $userID)
    {

        $sql = "INSERT INTO " . $this->table_name . " (addressName,ward,district,city,status,userID) VALUES(?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $addressName);
        $stmt->bindValue(2, $ward);
        $stmt->bindValue(3, $district);
        $stmt->bindValue(4, $city);
        $stmt->bindValue(5, $status);
        $stmt->bindValue(6, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $response = new Response(1, "Insert address success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }

    public function updateAddressInfo($data, $type, $addressID, $userID)
    {
        switch ($type) {
            case "ADDRESSNAME":
                return $this->updateAddressName($data, $addressID, $userID);
            case "DISTRICT":
                return $this->updateDistrict($data, $addressID, $userID);
            case "WARD":
                return $this->updateWard($data, $addressID, $userID);
            case "CITY":
                return $this->updateCity($data, $addressID, $userID);
            case "STATUS":
                return $this->updateAddressStatus($data, $addressID, $userID);
        }
    }

    public function updateAddressName($addressName, $addressID, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET addressName=? WHERE addressID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $addressName);
        $stmt->bindValue(2, $addressID);
        $stmt->bindValue(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Update address district success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }

    public function updateWard($ward, $addressID, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET ward=? WHERE addressID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $ward);
        $stmt->bindValue(2, $addressID);
        $stmt->bindValue(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Update address ward success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }

    public function updateDistrict($district, $addressID, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET district=? WHERE addressID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $district);
        $stmt->bindValue(2, $addressID);
        $stmt->bindValue(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Update address district success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }

    public function updateCity($city, $addressID, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET city=? WHERE addressID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $city);
        $stmt->bindValue(2, $addressID);
        $stmt->bindValue(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            $response = new Response(1, "Update address city success", null);
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }



    public function updateAddressStatus($status, $addressID, $userID)
    {
        $sql = "UPDATE " . $this->table_name . " SET status=? WHERE addressID=? AND USERID=?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $status);
        $stmt->bindValue(2, $addressID);
        $stmt->bindValue(3, $userID);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->execute()) {
            if ($status == 1) {
                $sql = "UPDATE " . $this->table_name . " SET status=2 WHERE addressID!=? AND USERID=?";
                $stmt = $this->connection->prepare($sql);
                $stmt->bindValue(1, $addressID);
                $stmt->bindValue(2, $userID);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                if ($stmt->execute()) {
                    $response = new Response(1, "Update address default status success", null);
                } else {
                    $response = new Response(0, "Something wrong happen", null);
                }
            } else {
                $response = new Response(1, "Update address status success", null);
            }
        } else {
            $response = new Response(0, "Something wrong happen", null);
        }
        return $response;
    }
}
