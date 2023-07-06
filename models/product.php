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
    public $status;
    public $brandID;
    public $screenID;
    public $operatingSystemID;
    public $processorID;
    public $memoryID;
    public $storageID;
    public function __construct($productID, $productName, $productPrice, $productQuantity, $releasedDate, $totalRating, $modelCode, $onSale, $currentPrice, $manufacturer, $warranty, $sold, $status, $brandID, $screenID, $operatingSystemID, $processorID, $memoryID, $storageID)
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
        $this->status = $status;
        $this->brandID = $brandID;
        $this->screenID = $screenID;
        $this->operatingSystemID = $operatingSystemID;
        $this->processorID = $processorID;
        $this->memoryID = $memoryID;
        $this->storageID = $storageID;
    }
}
