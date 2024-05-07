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
    // $response = $data ;
     if ($data === null) 
     {
      
    $response = "invalid" ;
     
    }
    else{
        $sem = $data['sem'];
        $branch = $data['branch'];
        $subject = $data['subject'];
        $whichmarks = $data['selectedOption'];

        $sql = "SELECT  s.semrollno , r.$whichmarks , r.sid FROM `result`as r CROSS JOIN studentsem as s
         WHERE r.sem = '$sem' and r.branch = '$branch' and r.subject = '$subject' AND r.sid = s.sid and s.semno = '$sem' order by s.semrollno " ;
        $result = mysqli_query($conn,$sql);
        $tempresult = array();
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tempresult[] = $row; 
            }
        
        $response = $tempresult ;
    }
    else{
        $response = "sql error  ";
    }
    }
}

echo json_encode($response);

?>