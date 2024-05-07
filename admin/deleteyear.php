<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
require '../vendor/autoload.php';
require '../myCollaction/xlsx.php';
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

try {
    
    
 
} catch (Exception $e) {
    return "Error: " . $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response;
    $json_data = json_decode(file_get_contents('php://input'), true);
    if (isset($json_data['branch'], $json_data['enrollmentyear'])) {
        $branch = $json_data['branch'];
        $enrollmentYear = $json_data['enrollmentyear'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM `result` WHERE branch = ? AND enrollmentyear = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("si", $branch, $enrollmentYear);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $response = array("message" => "Data deleted successfully");
            } else {
                $response = array("error" => "No matching records found for deletion");
            }
            $stmt->close();
        } else {
            $response = array("error" => "Error in preparing the SQL statement: " . $conn->error);
        }



    //     $xlsx = new xlsxdownload();
    //     // $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
    //     $branch = 'IT';
        
    //     $sem = '2';
    //     $query = "SELECT * FROM `result` WHERE `branch` = '$branch' AND `sem` = '$sem'";
    //     $result = $conn->query($query);
    //    $xlsx->download_query_result($result);
           
    //     $conn->close();
    
    //     return $response;






        $conn->close();
    } else {
        $response = array("error" => "Missing required fields in JSON data");
    }
} else {
    $response = array("error" => "Unsupported request method");
}
echo json_encode($response);

?>
