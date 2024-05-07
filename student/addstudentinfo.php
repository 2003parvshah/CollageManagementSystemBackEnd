
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
    if (isset($json_data['name'], $json_data['gender'], $json_data['birthdate'], $json_data['birthplace'], $json_data['enrollmentyear'],  $json_data['acpc_rank'], $json_data['cast_category'], $json_data['subcast'], $json_data['motherTongue'], $json_data['nationality'], $json_data['after'], $json_data['degree'])) {
        $name = $json_data['name'];
        $gender = $json_data['gender'];
        $birthdate = $json_data['birthdate'];
        $birthplace = $json_data['birthplace'];
        $enrollmentyear = $json_data['enrollmentyear'];
        $branch = $json_data['branch'];
        // $sid = $json_data['sid'];
        $acpc_rank = $json_data['acpc_rank'];
        $cast_category = $json_data['cast_category'];
        $subcast = $json_data['subcast'];
        $motherTongue = $json_data['motherTongue'];
        $nationality = $json_data['nationality'];
        $after = $json_data['after'];
        $degree = $json_data['degree'];
        $gujcat = $json_data['gujcat'];
        $sid = $json_data['sid'];

      

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }






  // Prepare SQL statement to insert data into the database
  $sql = "INSERT INTO studentbasicinfo (name, gender, birthdate, birthplace, enrollmentyear, acpc_rank, cast_category, subcast, motherTongue, nationality, after, degree , gujcat , sid , branch) 
  VALUES ('$name', '$gender', '$birthdate', '$birthplace', '$enrollmentyear', '$acpc_rank', '$cast_category', '$subcast', '$motherTongue', '$nationality', '$after', '$degree' , '$gujcat' , '$sid' , '' )";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
$response = array("message" => "Data inserted successfully");
// echo "done" ;
} else {
$response = array("error" => "Error inserting data: " . $conn->error);
echo "error" ;
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
