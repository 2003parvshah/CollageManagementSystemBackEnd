<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json_data = json_decode(file_get_contents('php://input'), true);
    if (isset($json_data['sem'], $json_data['branch'], $json_data['subject'])) {
        
        $sem = $json_data['sem'];
        $branch = $json_data['branch'];
        $subject = $json_data['subject'];
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "DELETE FROM `sem` WHERE sem = ? AND branch = ? AND subject = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $sem, $branch, $subject);
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
        $conn->close();
    } else {
        $response = array("error" => "Missing required fields in JSON data");
    }
} else {
    $response = array("error" => "Unsupported request method");
}
echo json_encode($response);

?>
