<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/RatingImageController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    $response = (new RatingImageController())->getAllRatingImages();
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);