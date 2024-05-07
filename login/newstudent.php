<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
require '../connection.php';

// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        http_response_code(400); // Bad Request
        echo "invalid" ;
    }
    $email = $data['Email'];
    $newpassword = $data['newpassword'];
    $sql = "INSERT INTO `login` (`id`, `email`, `type`, `pass`, `otp`) VALUES (NULL, '$email', '4', '$newpassword', NULL)";
$result = mysqli_query($conn,$sql);

$sql2 = "select * from `login` where email = '$email' and pass = '$newpassword' and type = 4 " ;
$resultfinal = mysqli_query($conn, $sql2);

if ($resultfinal) {
    // Fetch the single row as an associative array
    $row = mysqli_fetch_assoc($resultfinal);

    if ($row) {
        // Output the value of the 'sid' column
        // echo "SID: " . $row['id'];
    } else {
        echo "No matching row found.";
    }
} else {
    echo "SQL error: " . mysqli_error($conn);
}

if ($result)
{
//  $row = $result->fetch_assoc();
 $response = array('newpasswordstatus' => "true", 'message' => 'true newpassword' , 'sid' =>  $row['id'] );
}
else
{
$response = array('newpasswordstatus' => "false", 'message' => 'Invalid  newpassword');
}
}
echo json_encode($response);

?>