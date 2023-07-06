<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../controllers/MemoryController.php';
include_once '../../models/response.php';

$input = json_decode(file_get_contents('php://input'));

$response = null;
try {
    if (
        isset($input->memoryID) && isset($input->currentRAM) && isset($input->type) && isset($input->speed)
        && isset($input->maxSlots) && isset($input->availableSlots) && isset($input->maxRam) && isset($input->status)
    ) {
        $response = (new MemoryController())->updateMemoryByID(
            $input->memoryID, 
            $input->currentRAM,
            $input->type,
            $input->speed,
            $input->maxSlots,
            $input->availableSlots,
            $input->maxRam,
            $input->status);
    } else {
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
