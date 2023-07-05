<?php 
 
class Address{
    public $addressID;
    public $addressName;
    public $district;
    public $ward;
    public $city;
    public $status;
    public $userID;

    public function __construct($addressID, $addressName, $ward, $district, $city,$status,$userID)
    {
        $this->addressID = $addressID;
        $this->addressName = $addressName;
        $this->ward = $ward;
        $this->district = $district;
        $this->city = $city;
        $this->status = $status;
        $this->userID = $userID;
    }

}

?>
