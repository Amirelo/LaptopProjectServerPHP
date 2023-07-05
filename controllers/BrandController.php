<?php 
include_once '../../services/BrandService.php';

class BrandController{
    private $brandService;

    public function __construct(){
        $this->brandService = new BrandService();
    }

    public function getAllBrands(){
        return $this->brandService->getAllBrands();
    }
    
    public function getBrandsByID($brandID){
        return $this->brandService->getBrandsByID($brandID);
    }

    public function insertBrand($brandName){
        return $this->brandService->insertBrand($brandName);
    }

    public function updateBrandByID($brandID,$brandName,$status){
        return $this->brandService->updateBrandByID($brandID,$brandName,$status);
    }
}


?>