<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/UserOrderController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (
    isset($input->totalPrice) && isset($input->originalPrice) && isset($input->note) 
    && isset($input->receiver) && isset($input->shippingFee) && isset($input->paymentType) 
    && isset($input->addressID) && isset($input->userID) && isset($input->couponID)
    ) {
        $response = (new UserOrderController())->insertUserOrderInfo(
            $input->totalPrice,
            $input->originalPrice,
            $input->note,
            $input->receiver,
            $input->shippingFee,
            $input->paymentType,
            $input->addressID,
            $input->userID,
            $input->couponID);
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
