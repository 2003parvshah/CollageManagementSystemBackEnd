<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST')
{ 
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        echo "invalid" ;
    }
    $branch = $data['branch'];
    $curriculum = $data['curriculum'];
    $sem = $data['sem'];

    

$sqldelete = "DELETE FROM `sem` WHERE sem = '$sem' AND branch = '$branch' " ;
if ($conn->query($sqldelete) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}




foreach($curriculum as $item) 
{

  
    $subject = $conn->real_escape_string($item['subject']);
    $sub_credit = $conn->real_escape_string($item['sub_credit']);
    echo "\n" .$sub_credit  ;


    $sql2 = "INSERT INTO `sem` (`sem`, `branch`, `subject`, `sess1`, `sess2`, `sess3`, `viva`, `external`, `att1`, `att2`, `att3`, `total_att_1`, `total_att_2`, `total_att_3`, `block`, `practical`, `termwork`, `sub_point`, `sub_credit`, `sub_grade`) VALUES ('$sem', '$branch', '$subject',1,1,1,1,1, 1,1,1,1, 1, 1, 1, 1, 1, 1, '$sub_credit', 'o')";
    if ($conn->query($sql2) === TRUE) {
      
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}




}

// echo json_encode($response);

?>