<?php

// INSERT INTO `result` (`sid`, `branch`, `enrollmentyear`, `sem`, `subject`, `sess1`, `att1`, `sess2`, `att2`, `sess3`, `att3`, `block`, `viva`, `practical`, `termwork`, `external`)
// SELECT t.sid , t.branch , t.enrollmentyear , tt.sem , tt.subject , tt.sess1 , tt.att1 , tt.sess2 , tt.att2 , tt.sess3 , tt.att3 , tt.block , tt.viva , tt.practical , tt.termwork , tt.external
// FROM
// (SELECT sid , branch , enrollmentyear FROM studentbasicinfo)
// as t
// CROSS JOIN 
// (SELECT sem , subject ,branch, sess1 , att1 , sess2 , att2 , sess3 , att3 , block , viva , practical , termwork , external FROM sem)
// as tt
// WHERE (tt.sem = 1) and (tt.branch = t.branch) AND (t.enrollmentyear = 2021) AND (t.branch = 'IT')
// ;








header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
// $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
require '../connection.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $data = json_decode(file_get_contents("php://input"), true);
    if ($data === null) {
        echo "invalid" ;
    }
    $branch = $data['branch'];
    $enrollmentyear = $data['enrollmentyear'];
    $sem = $data['sem'];
    // $sql = "INSERT INTO `result` (`sid`, `branch`, `enrollmentyear`, `sem`, `subject`, `sess1`, `att1`, `sess2`, `att2`, `sess3`, `att3`, `block`, `viva`, `practical`, `termwork`, `external`)


$sql = "
    INSERT INTO `result` (`sid`, `branch`, `enrollmentyear`, `sem`, `subject`, `sess1`, `att1`, `sess2`, `att2`, `sess3`, `att3`, `block`, `viva`, `practical`, `termwork`, `external`)
    SELECT t.sid, t.branch, t.enrollmentyear, tt.sem, tt.subject, tt.sess1, tt.att1, tt.sess2, tt.att2, tt.sess3, tt.att3, tt.block, tt.viva, tt.practical, tt.termwork, tt.external
    FROM
        (SELECT sid, branch, enrollmentyear FROM studentbasicinfo) AS t
    CROSS JOIN
        (SELECT sem, subject, branch, sess1, att1, sess2, att2, sess3, att3, block, viva, practical, termwork, external FROM sem) AS tt
    WHERE (tt.sem = '$sem') AND (tt.branch = t.branch) AND (t.enrollmentyear = '$enrollmentyear') AND (t.branch = '$branch')
";
// $result = mysqli_query($conn,$sql);
if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully in result";

    
$sql1 = "
select sid , name  from studentbasicinfo where branch = '$branch' and enrollmentyear = '$enrollmentyear'
ORDER BY name
";
$result1 = $conn->query($sql1);
$rollNumber = 1; 
while ($row = $result1->fetch_assoc()) {

    // echo $row['sid'] ;
    $sid = $row['sid'];
    $sql2 = "INSERT INTO `studentsem` (`sid`, `semno`, `semrollno`) VALUES ('$sid', '$sem', '$rollNumber')";
    if ($conn->query($sql2) === TRUE) {
        echo "";
        $rollNumber++;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}



} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


// echo json_encode($response);
}
?>