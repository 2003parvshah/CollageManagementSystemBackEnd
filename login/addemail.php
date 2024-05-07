<?php
require '../myCollaction/gmail.php';
$g = new gmail();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

$response = "method is not post" ;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        http_response_code(400); 
    } 
    $email = $data['Email']; 
    // $OTP = random_int(1000, 9999);
{
    $password = random_int(1000, 9999);
    $response = array('ans' => $g->sendmail($email , 'OTP' , $password) , 'email' => $email , 'otp' => $password);
}
}
echo json_encode($response);    

?>
