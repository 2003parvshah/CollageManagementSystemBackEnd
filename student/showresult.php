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
        $sid = $data['sid'];
        $sem = $data['sem'];
        $sql = "SELECT * FROM `result` WHERE `sid` = '$sid'  and `sem` = '$sem' " ;
        // $result = mysqli_query($conn,$sql);
        $tempresult = array();

        $result2 = mysqli_query($conn,$sql);
        $row2 = $result2->fetch_assoc();
        $branch =  $row2['branch'];
        // echo $branch ;

        $sql1 = "SELECT s.sub_grade, s.sub_credit, r.sid, r.branch, r.enrollmentyear, r.sem, r.subject, r.sess1, r.att1, r.sess2, r.att2, r.sess3, r.att3, r.block, r.viva, r.practical, r.termwork, r.external 
        FROM `sem` AS s 
        CROSS JOIN `result` AS r 
        WHERE s.sem = '$sem' 
        -- AND s.branch = '$branch'
         AND r.subject = s.subject
         AND r.sem = '$sem' AND r.sid = '$sid'";
        $resultfinal = mysqli_query($conn, $sql1);

        if ($resultfinal) {
            // echo "out" ;
            while ($row = $resultfinal->fetch_assoc()) {
                $tempresult[] = $row; 
                // echo "in " ;
            }
        
        $response = $tempresult ;
    }
    else{
        $response = "sql error  " . $sql1;
    }

    }
}

echo json_encode($response);

?>