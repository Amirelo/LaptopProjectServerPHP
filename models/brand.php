<?php 
class Brand{
    public $brandID;
    public $name;
    public $status;

    public function __construct($brandID, $name,$status){
        $this->brandID = $brandID;
        $this->name = $name;
        $this->status = $status;
    }
}
?>