<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/OrderDetailController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (isset($input->productQuantity) 
    && isset($input->userOrderID) 
    && isset($input->productID)) {
        $response = (new OrderDetailController())->insertOrderDetail($input->productQuantity, $input->userOrderID, $input->productID);
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
