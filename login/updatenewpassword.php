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
    $newpassword = $data['newpassword'];
// $sql = "SELECT * FROM `login` WHERE (`email` = '$email') and (`newpass` = '$newpassword')" ;
$sql = "UPDATE `login` SET `pass` = '$newpassword' WHERE `login`.`email` = '$email'";
$result = mysqli_query($conn,$sql);

if ($result)
{
//  $row = $result->fetch_assoc();
 $response = array('newpasswordstatus' => "true", 'message' => 'true newpassword' );
}
else
{
$response = array('newpasswordstatus' => "false", 'message' => 'Invalid  newpassword');
}
}
echo json_encode($response);

?>