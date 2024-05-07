<?php

require '../myCollaction/gmail.php';
$g = new gmail();

// echo "hello" ;


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

$response = "method is not post" ;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        // $response = array("error" => "Invalid JSON data");
        // echo "invalid" ;
    }
    $email = $data['Email']; 
    $sql = "SELECT * FROM login WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // echo "Email exists in the database";
    // $response = array('ans' => $g->sendmail($email , 'OTP' , $password));

    

    $password = random_int(1000, 9999);
    $response = array('ans' => $g->sendmail($email , 'OTP' , $password));
    $sql = "UPDATE login SET otp = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password, $email);
    $stmt->execute();

} else {
    // echo "Email does not exist in the database";
    $response = array('ans' => "Email does not exist in the database");
}
}

echo json_encode($response);

?>
