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
     if ($data === null) 
     {
    $response = "invalid" ;
    }
    else{
$sem = $data['sem'];
$branch = $data['branch'];
$subject = $data['subject'];
$selectedOption = $data['selectedOption'];
$atts = $data['atts'];


$sql = "SELECT  s.semrollno , r.$selectedOption , r.sid FROM `result`as r CROSS JOIN studentsem as s
WHERE r.sem = '$sem' and r.branch = '$branch' and r.subject = '$subject' AND r.sid = s.sid and s.semno = '$sem' order by s.semrollno " ;
   $result = mysqli_query($conn,$sql);
   if ($result) {
       while (($row = $result->fetch_assoc())  && ($att = current($atts))) {
        // echo "semrollno: " . $att['semrollno'] . ", sess2: " . $att['sess2'] . ", sid: " . $att['sid'] . "\n";
        $sid = $att['sid'] ;
        $sql2 = "UPDATE `result` SET `$selectedOption` = '$att[$selectedOption]' WHERE `result`.`sid` = $sid AND `result`.`branch` = '$branch'  AND `result`.`sem` = '$sem' AND `result`.`subject` = '$subject';";
        if ($conn->query($sql2) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        next($atts);
       }
}
else{
   $response = "sql error  ";
}
    }
}

// echo json_encode($response);

?>