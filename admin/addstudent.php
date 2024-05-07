<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'GET') 
{
   
    $data = json_decode(file_get_contents("php://input"), true);
    // $response = $data ;
    //  if ($data === null) 
    //  {
      
    // $response = "invalid" ;
     
    // }
    // else{
       

        $sql = "SELECT * FROM `studentbasicinfo` WHERE branch is null or branch = ''  ORDER BY gujcat DESC" ;
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
// }

echo json_encode($response);

?>