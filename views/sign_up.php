<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../controllers/UserController.php';

$input = json_decode(file_get_contents("php://input"));

$response = null;
try{
    if(isset($input->username) 
    && isset($input->userPassword)
    && isset($input->email)
    && isset($input->phonenumber)
    && isset($input->fullname)
    && isset($input->gender)
    && isset($input->birthday)) {
        $response = (new UserController())->SignUp($input->username,$input->userPassword,$input->email,$input->phonenumber, $input->fullname, $input->gender, $input->birthday);
    } else{
        $response = new Response(3, "Not enough parameters", null);
    }
} catch(Exception $e){
    $response = new Response(4,$e->getMessage(), null);
}

echo json_encode($response);
?>