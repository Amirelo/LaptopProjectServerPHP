<?php 

include_once '../../services/ProductService.php';

class ProductController{
    private $productService;
    public function __construct(){
        $this->productService = new ProductService();
    }

    public function getAllProducts(){
        return $this->productService->getAllProducts();
    }

    public function getProductByID($productID){
        return $this->productService->getProductByID($productID);
    }

    public function insertProductInfo($productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        return $this->productService->insertProductInfo($productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID);
    }

    public function updateProductByID($productID, $productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID){
        return $this->productService->updateProductByID($productID, $productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID);
    }
}

?>