<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
require_once '../../models/response.php';

try{
$mail = new PHPMailer(true);
$mail->SMTPDebug = 1;                  
$mail->isSMTP();                       
$mail->Host       = 'sandbox.smtp.mailtrap.io';    
$mail->SMTPAuth   = true;              
$mail->Username   = 'd661433d20cd95';    
$mail->Password   = '9be21f7e199414';         
$mail->SMTPSecure = 'tls';              
$mail->Port       = 587;    

$mail->setFrom('from@gfg.com', 'Name');           
$mail->addAddress('receiver1@gfg.net');           
$mail->addAddress('receiver2@gfg.com', 'Name'); 
//$mail->addAttachment('url', 'filename');
$mail->isHTML(true);                                  
$mail->Subject = 'Subject';
$mail->Body    = 'HTML message body in <b>bold</b>!';
$mail->AltBody = 'Body in plain text for non-HTML mail clients';
$mail->send();
$response = new Response(1, "Send success", null);
} catch(Exception $e){
    $response = new Response(3, "Message cannot be sent", null);
}
echo json_encode($response);
?>