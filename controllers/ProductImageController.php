<?php 

include_once '../../services/ProductImageService.php';

class ProductImageController{
    private $productImageService;
    public function __construct(){
        $this->productImageService = new ProductImageService();
    }

    public function getAllProductImages(){
        return $this->productImageService->getAllProductImages();
    }

    public function getProductImagesByProductID($productID){
        return $this->productImageService->getProductImagesByProductID($productID);
    }

    public function insertProductImageInfo($productImageLink, $status, $productID){
        return $this->productImageService->insertProductImageInfo($productImageLink, $status,$productID);
    }

    public function updateProductImageByID($productImageID,$productImageLink,$status,$productID){
        return $this->productImageService->updateProductImageByID($productImageID,$productImageLink,$status,$productID);
    }
}

?>