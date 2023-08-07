<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/ProductController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (
        isset($input->productName) &&
        isset($input->productPrice) &&
        isset($input->productQuantity) &&
        isset($input->releasedDate) &&
        isset($input->modelCode) &&
        isset($input->onSale) &&
        isset($input->currentPrice) &&
        isset($input->manufacturer) &&
        isset($input->warranty) &&
        isset($input->sold) &&
        isset($input->length) &&
        isset($input->width) &&
        isset($input->height) &&
        isset($input->weight) &&
        isset($input->brandID) &&
        isset($input->screenID) &&
        isset($input->operatingSystemID) &&
        isset($input->processorID) &&
        isset($input->memoryID) &&
        isset($input->storageID)
    ) {
        $response = (new ProductController())->insertProductInfo(
            $input->productName,
            $input->productPrice,
            $input->productQuantity,
            $input->releasedDate,
            $input->modelCode,
            $input->onSale,
            $input->currentPrice,
            $input->manufacturer,
            $input->warranty,
            $input->sold,
            $input->length,
            $input->width,
            $input->height,
            $input->weight,
            $input->brandID,
            $input->screenID,
            $input->operatingSystemID,
            $input->processorID,
            $input->memoryID,
            $input->storageID
        );
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
