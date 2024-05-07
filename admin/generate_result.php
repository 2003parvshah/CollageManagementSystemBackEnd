<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';


function getresult($conn , $sess1=0 , $sess2=0 , $sess3=0 , $att1=0 , $att2=0 , $att3=0 ,$total_att1=0 , $total_att2=0 , $total_att3=0 ,$block=0 ,  $viva=0 , $practical=0 , $termwork=0 , $external=0 , $sid=0 , $sem =1, $subject="0" )
{
    $grade = "";
    $attmark = 0;
    $sub_point = 0 ;
    $total =  $total_att1 + $total_att2 + $total_att3 ;
    $my_att = $att1 + $att2 + $att3 ;
    $ans = "[";
    $pr_att = (($my_att / $total)*100);
    if($pr_att > 80){
    $attmark = 4 ;}
    else if($pr_att > 75){
    $attmark = 3 ;}
    else if($pr_att > 60){
    $attmark = 2 ;}
    else if($pr_att > 50){
    $attmark = 1 ;}
    else {
        $ans .= "low attendance , "  ;
    }

    $sess_total = $sess1 + $sess2 + $sess3 ;
    if($sess_total < 24)
    {
        $ans .= "low sess mark ," ; 
        // $sess_total = $sess_total / 3 ;

    }
    if($external < 18 )
    {
        if($external < 24 && $viva==0 && $termwork==0){
        $ans .= "fail in external ," ;
        }
        $ans .= "fail in external ," ;
    }
    $sess_total = $sess_total / 3 ;
    $sub_total = $sess_total + $attmark + $termwork + $viva + $practical + $external ;
    // echo $sub_total . "\n" ;
    $sub_pr = 0 ;
    if($viva==0 && $termwork==0 && $practical==0 )
    {
        $sub_pr = (($sub_total/100)*100);
    }
    else
    {
        $sub_pr = (($sub_total/150)*100);
    }

    if($sub_pr < 100 && $sub_pr > 84.50)
    {
        $grade = "AA" ;
        $sub_point = 10 ;
    }
    else if($sub_pr < 84.49 && $sub_pr > 74.50)
    {
        $grade = "AB" ;
        $sub_point = 9 ;

    }
    else if($sub_pr < 74.49 && $sub_pr > 64.50)
    {
        $grade = "BB" ;
        $sub_point = 8 ;

    }
    else if($sub_pr < 64.49 && $sub_pr > 54.50)
    {
        $grade = "BC" ;
        $sub_point = 7 ;

    }
    else if($sub_pr < 54.49 && $sub_pr > 44.50)
    {
        $grade = "CC" ;
        $sub_point = 6;

    }
    else if($sub_pr < 44.49 && $sub_pr > 39.50)
    {
        $grade = "CD" ;
        $sub_point = 5 ;

    }
    else if($sub_pr < 39.49 && $sub_pr > 0)
    {
        $grade = "FF" ;
        $sub_point = 0 ;
    }
    $sql2 = "UPDATE `result` set  sub_grade = '$grade' , sub_point = '$sub_point' where sid = '$sid' and sem = '$sem' and subject = '$subject' ";
    if ($conn->query($sql2) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    
    return $grade ;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{ 
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        echo "invalid" ;
    }
    $branch = $data['branch'];
    $enrollmentyear = $data['enrollmentyear'];
    $sem = $data['sem'];

$ro = 0 ;
    
$sql1 = "select result.* , totalatt.total_att1 , totalatt.total_att2 , totalatt.total_att3
  FROM result  INNER JOIN totalatt
   ON result.branch = totalatt.branch and result.sem = totalatt.sem and result.enrollmentyear = totalatt.enrollmentyear and result.subject = totalatt.subject 
   
   where result.sem = '$sem' and result.branch = '$branch' and result.enrollmentyear = '$enrollmentyear' and totalatt.sem = '$sem' and totalatt.branch = '$branch' and totalatt.enrollmentyear = '$enrollmentyear' ";
$result1 = $conn->query($sql1);
while ($row = $result1->fetch_assoc()) {
    
    $grade =  getresult($conn , $row['sess1'] , $row['sess2'] , $row['sess3'] , $row['att1'] , $row['att2'] , $row['att3'] ,$row['total_att1'] , $row['total_att2'] , $row['total_att3'] ,$row['block'] ,  $row['viva'] , $row['practical'] , $row['termwork'] , $row['external']  , $row['sid'], $row['sem'] , $row['subject']);
  
    // echo $grade . $ro;
$ro++;
}





$sql3 = "select sid , ROUND(AVG(sub_point), 2) AS spi from result where sem = '$sem' and branch = '$branch' and enrollmentyear = '$enrollmentyear'    GROUP BY sid"  ;
$result3 = $conn->query($sql3);
while ($row = $result3->fetch_assoc()) 
{
    foreach ($row as $key => $value) {
        // echo "$key: $value\n";
    }
    $spi = $row['spi'] ;
    $sid = $row['sid'] ;
    echo $spi . $sid . "\n";
    $sql4 = "UPDATE `studentsem` SET spi='$spi' WHERE sid = '$sid' and semno = '$sem' " ;   
    if ($conn->query($sql4) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}

} else {
    echo "Error: " . $sql . $conn->error;
}
// echo json_encode($response);
// }
?>