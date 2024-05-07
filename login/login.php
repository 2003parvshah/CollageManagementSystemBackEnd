<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

$response = array('success' => false, 'message' => 'Invalid username or password');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : 'Guest';
    $password = isset($_POST['password']) ? $_POST['password'] : 'Guest';

    $name = isset($_GET['name']) ? $_GET['name'] : 'Guest';
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        // JSON decoding failed
        http_response_code(400); // Bad Request
        // $response = array("error" => "Invalid JSON data");
        echo "invalid";
    }
    $username = $data['username'];
    $password = $data['password'];
    $sql = "SELECT * FROM `login` WHERE (`email` = '$username') and (`pass` = '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $type = $row["type"];
        $id = $row["id"];

        $response = array('success' => true, 'message' => 'Login successful', 'id' => $id, 'type' => $type);
    } else {
        //  echo "wrong password" ;
        $response = array('success' => false, 'message' => 'Invalid username or password');
    }
}
echo json_encode($response);

?>