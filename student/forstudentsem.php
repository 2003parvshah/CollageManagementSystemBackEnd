<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = json_decode(file_get_contents('php://input'), true);
    if (isset($json_data['sid'])) {
        $sid = $json_data['sid'];
        $sql1 = "select enrollmentyear from studentbasicinfo where sid = '$sid'" ;
        $result1 = mysqli_query($conn , $sql1);
        $row1 = $result1->fetch_assoc() ;
        // echo $row1['enrollmentyear'] ;
        $year = $row1['enrollmentyear'] ;
        $sql = "SELECT semno , semrollno ,  '$year' as year FROM `studentsem` WHERE sid = '$sid'";
        // $stmt = $conn->prepare($sql);
        // $stmt->bind_param("i", $sid);
        // $stmt->execute();
        $result =  mysqli_query($conn, $sql);   
        if ($result->num_rows > 0) {
            // Fetch rows and store in array
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            // Convert array to JSON and send response
            echo json_encode($rows);
        } else {
            // No rows found
            $response = array("message" => "No data found for the given SID");
            echo json_encode($response);
        }
    
        // Close database connection
        $conn->close();
    }
}
    ?>