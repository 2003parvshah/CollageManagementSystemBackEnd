
<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
require '../connection.php';
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data from the request body
    $json_data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present in the JSON data
    if (1) {
       
        $sid = $json_data['sid'];
        // $branch = $json_data['branch'];

        // $servername = "localhost";
        // $username = "root";
        // $password = "1256";
        // $dbname = "sdp";
        // $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }






  // Prepare SQL statement to insert data into the database
  $sql = "DELETE FROM `studentbasicinfo` WHERE sid = '$sid'";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
$response = array("message" => "student rejected");
// echo "done" ;
} else {
$response = array("error" => "Error inserting data: " . $conn->error);
// echo "error" ;
}





        $conn->close();
    } else {
        $response = array("error" => "Missing required fields in JSON data");
    }
} else {
    $response = array("error" => "Unsupported request method");
}

// Send the JSON response
echo json_encode($response);

?>
