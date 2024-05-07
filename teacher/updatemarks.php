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
$marks = $data['marks'];


$sql = "SELECT  s.semrollno , r.$selectedOption , r.sid FROM `result`as r CROSS JOIN studentsem as s
WHERE r.sem = '$sem' and r.branch = '$branch' and r.subject = '$subject' AND r.sid = s.sid and s.semno = '$sem' order by s.semrollno " ;
   $result = mysqli_query($conn,$sql);
   $tempresult = array();
   if ($result) {
       while (($row = $result->fetch_assoc())  && ($mark = current($marks))) {
        // echo "semrollno: " . $mark['semrollno'] . ", sess2: " . $mark['sess2'] . ", sid: " . $mark['sid'] . "\n";
        $tempresult[] = $row; 
        $sid = $mark['sid'] ;

        $sql = "UPDATE `result` SET `$selectedOption` = '$mark[$selectedOption]' WHERE `result`.`sid` = $sid AND `result`.`branch` = '$branch'  AND `result`.`sem` = '$sem' AND `result`.`subject` = '$subject';";
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
        
        
        next($marks);
       }
   
   $response = $tempresult ;
}
else{
   $response = "sql error  ";
}



// $m = $mark[]

       

    }
}

// echo json_encode($response);

?>