<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$input = json_decode(file_get_contents("php://input"));

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
require_once '../../models/response.php';

try {
    if(isset($input->email)){
    $verfifyCode = rand(100000,999999);

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'd661433d20cd95';
    $mail->Password   = '9be21f7e199414';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('laparonshon@gmail.com', 'LapapronShon');
    $mail->addAddress($input->email);
    //$mail->addAttachment('url', 'filename');
    $mail->isHTML(true);
    $mail->Subject = 'Verification code';
    $mail->Body    = 'Your code is: '.$verfifyCode;
    $mail->AltBody = 'Do not share this code with anyone';
    $mail->send();
    $response = new Response(1, "Send success", $verfifyCode);
    } else{
        $response = new Response(3, "Not enough parameters", null);
    }
} catch (Exception $e) {
    $response = new Response(4, $e->getMessage(), null);
}
echo json_encode($response);
