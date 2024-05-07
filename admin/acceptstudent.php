
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
        $branch = $json_data['branch'];

      

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }






  // Prepare SQL statement to insert data into the database
  $sql = "UPDATE `studentbasicinfo` SET `branch`='$branch' WHERE sid = '$sid'";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
$response = array("message" => "student accepted");
// echo "done" ;
} else {
$response = array("error" => "Error inserting data: " . $conn->error);
// echo "error" ;
}


$sql2 = "UPDATE `login` SET `type`='2' WHERE id = '$sid'" ;
if ($conn->query($sql2) === TRUE) {
    $response = array("message" => "student accepted");
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
