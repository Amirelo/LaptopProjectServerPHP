<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/ScreenController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (
        isset($input->screenID) && isset($input->resolution) && isset($input->screenSize) && isset($input->length)
        && isset($input->width) && isset($input->height) && isset($input->status)
    ) {
        $response = (new ScreenController())->updateScreenByID($input->screenID, $input->resolution, $input->screenSize, $input->length,  $input->width,  $input->height, $input->status);
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
