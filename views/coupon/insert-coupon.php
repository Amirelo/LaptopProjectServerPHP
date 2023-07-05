<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/CouponController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (
        isset($input->name) && isset($input->effect) && isset($input->maxEffectValue)
        && isset($input->couponCode) && isset($input->userID)
    ) {
        $response = (new CouponController())->insertCoupon($input->name, $input->effect, $input->maxEffectValue, $input->couponCode, $input->userID);
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
