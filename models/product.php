<?php
class Product
{
    public $productID;
    public $productName;
    public $productPrice;
    public $productQuantity;
    public $releasedDate;
    public $totalRating;
    public $modelCode;
    public $onSale;
    public $currentPrice;
    public $manufacturer;
    public $warranty;
    public $sold;
    public $length;
    public $width;
    public $height;
    public $weight;
    public $status;
    public $brandID;
    public $screenID;
    public $operatingSystemID;
    public $processorID;
    public $memoryID;
    public $storageID;
    public $productImageLink;

    public function __construct($productID, $productName, 
        $productPrice, $productQuantity, $releasedDate, $totalRating, 
        $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, 
        $sold, $length, $width, $height, $weight,
        $status, $brandID, $screenID, $operatingSystemID, $processorID, 
        $memoryID, $storageID,$productImageLink)
    {
        $this->productID = $productID;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->productQuantity = $productQuantity;
        $this->releasedDate = $releasedDate;
        $this->totalRating = $totalRating;
        $this->modelCode = $modelCode;
        $this->onSale = $onSale;
        $this->currentPrice = $currentPrice;
        $this->manufacturer = $manufacturer;
        $this->warranty = $warranty;
        $this->sold = $sold;
        $this -> length =$length;
        $this -> width =$width;
        $this -> height =$height;
        $this -> weight =$weight;
        $this->status = $status;
        $this->brandID = $brandID;
        $this->screenID = $screenID;
        $this->operatingSystemID = $operatingSystemID;
        $this->processorID = $processorID;
        $this->memoryID = $memoryID;
        $this->storageID = $storageID;
        $this->productImageLink = $productImageLink;
    }

}
