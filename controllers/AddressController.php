<?php 
include_once '../../services/AddressService.php';

class AddressController{
    public function getAllAddresses(){
        return (new AddressService())->getAllAddresses();
    }

    public function getAddressesByUserID($userID){
        return (new AddressService())->getAddressesByUserID($userID);
    }

    public function getAddressesByUsername($username){
        return (new AddressService())->getAddressesByUsername($username);
    }
    public function getAddressesByEmail($email){
        return (new AddressService())->getAddressesByEmail($email);
    }

    public function insertAddress($addressName,$ward,$district,$city,$status,$userID){
        return (new AddressService()) -> insertAddress($addressName,$ward,$district,$city,$status,$userID);
    }

    public function updateAddressInfo($data, $type, $addressID, $userID){
        return (new AddressService())->updateAddressInfo($data, $type, $addressID,$userID);
    }

}

?>