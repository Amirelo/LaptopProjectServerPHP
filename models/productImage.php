<?php 
class ProductImage{
    public $productImageID;
    public $productImageLink;
    public $status;
    public $productID;

    public function __construct($productImageID,$productImageLink,$status,$productID){
        $this-> productImageID = $productImageID;
        $this-> productImageLink = $productImageLink;
        $this-> status = $status;
        $this-> productID = $productID;
    }
}

?>