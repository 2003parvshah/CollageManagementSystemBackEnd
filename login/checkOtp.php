<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        http_response_code(400); // Bad Request
        echo "invalid" ;
    }
    $email = $data['Email'];
    $OTP = $data['OTP'];
$sql = "SELECT * FROM `login` WHERE (`email` = '$email') and (`otp` = '$OTP')" ;
$result = mysqli_query($conn,$sql);
if ($result->num_rows == 1)
{
 $row = $result->fetch_assoc();
 $response = array('otpstatus' => "true", 'message' => 'true otp' );
}
else
{
$response = array('otpstatus' => "false", 'message' => 'Invalid  OTP');
}
}
echo json_encode($response);

?>