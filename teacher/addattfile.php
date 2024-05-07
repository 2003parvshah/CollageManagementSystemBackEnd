<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json");
require '../vendor/autoload.php';
require '../connection.php'; // Assuming this contains your DB connection setup
require '../myCollaction.php';



use PhpOffice\PhpSpreadsheet\IOFactory;

// Function to convert an Excel file to a 2D array of row data
$xlsxconverter = new xlsxdownload();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file has been uploaded
    if (isset($_FILES['fileToUpload'])) {
        $file = $_FILES['fileToUpload'];
        $targetDir = __DIR__ . '/';
        $fileName = $file['name'];
        $targetPath = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            if (file_exists($targetPath)) {
                $rowData = $xlsxconverter->convertExcelToRowData($targetPath);

                // Do something with the $rowData array, like processing it or updating the database
                // Example: Just return the processed row data in the response
                $response = ['success' => true, 'message' => 'File processed successfully', 'data' => $rowData];
            } else {
                $response = ['success' => false, 'message' => 'File not found after moving'];
            }
        } else {
            $response = ['success' => false, 'message' => 'Failed to move uploaded file'];
        }
    } else {
        $response = ['success' => false, 'message' => 'No file uploaded'];
    }
} else {
    $response = ['success' => false, 'message' => 'Request method is not POST'];
}

// Output JSON response
echo json_encode($response);

?>






<?php

// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Methods: *");
// header("Content-Type: application/json");
// require '../vendor/autoload.php';
// use PhpOffice\PhpSpreadsheet\IOFactory;
// // $conn = mysqli_connect('localhost', 'root', '1256', 'sdp');
// require '../connection.php';


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Check if file has been uploaded
//     if (isset($_FILES['fileToUpload'])) {
//         // Get the uploaded file details
//         $file = $_FILES['fileToUpload'];
//         $sem = $_POST['sem'];
//         $branch = $_POST['branch'];
//         $subject = $_POST['subject'];
//         $selectedOption = $_POST['selectedOption'];
//         // $sem = $_POST['sem'];
//         $column = true;
//         $cell;

//         // Define the target directory where the file will be stored
//         $targetDir = __DIR__ . '/';
//         $fileName = $file['name'];
//         // Define the target path where the file will be moved to
//         $targetPath = $targetDir . $fileName;
//         if (move_uploaded_file($file['tmp_name'], $targetPath)) {
//             if (file_exists($targetPath)) {
//                 $spreadsheet = IOFactory::load($targetPath);
//                 $sheet = $spreadsheet->getActiveSheet();
//                 $rowData = [];
//                 // $rowIterator = $sheet->getRowIterator();
//                 // Get the highest row number (i.e., the total number of rows in the worksheet)
//                 $rowCount = $sheet->getHighestRow();

//                 // Loop through each row
//                 for ($rowIndex = 1; $rowIndex <= $rowCount; $rowIndex++) {
//                     // Define an array to store cell data for the current row
//                     $rowDataForRow = [];

//                     // Get the cell iterator for the current row
//                     $cellIterator = $sheet->getRowIterator($rowIndex)->current()->getCellIterator();
//                     // echo $cellIterator;
//                     // print_r($cellIterator);
//                     // var_dump($cellIterator);


//                     // Loop through each cell in the row
//                     foreach ($cellIterator as $cell) {
//                         // Get the value of the cell
//                         $cellValue = $cell->getValue();
//                         // Add the cell value to the row data array for the current row
//                         $rowDataForRow[] = $cellValue;
//                         // echo $cellValue;
//                     }
//                     // echo $rowDataForRow[0];
//                     // echo $rowDataForRow[1];

//                     // Add the row data array to the main row data array
//                     $rowData[] = $rowDataForRow;
//                 }

//                 // echo $rowData[2][1];
//                 $response = ['success' => true, 'message' => 'File uploaded and processed successfully', 'data' => $rowData];
//             } else {
//                 $response = ['success' => false, 'message' => 'File not found after moving'];
//             }
//         } else {
//             $response = ['success' => false, 'message' => 'Failed to move uploaded file'];
//         }









//         // echo $sem . $branch . $subject . "value";
//         $sql = "SELECT * FROM studentsem CROSS JOIN result WHERE result.sem = '$sem' AND studentsem.semno = '$sem' AND result.branch = '$branch' AND result.subject = '$subject' AND studentsem.sid = result.sid";

//                 $result = mysqli_query($conn, $sql);
//                 if ($result) {
//                     $tempresult = array();
//                     $i = 0  ;
//                     while ($row = $result->fetch_assoc()) {
//                         // echo "in while";
//                         // echo "semrollno: " . $mark['semrollno'] . ", sess2: " . $mark['sess2'] . ", sid: " . $mark['sid'] . "\n";
//                         $tempresult[] = $row;
//                         // $sid = $mark['sid'];
//                         $i++; 
//                         // $sql2 = "UPDATE `result` cross Join `studentsem` SET result.`$selectedOption` = '$rowData[$i][1]' WHERE `studentsem`.`semrollno` = '$rowData[$i][0]' AND `result`.`branch` = '$branch'  AND `result`.`sem` = '$sem' AND `result`.`subject` = '$subject' and result.sem = '$sem' AND studentsem.semno = '$sem' AND result.branch = '$branch' AND result.subject = '$subject' AND studentsem.sid = result.sid ";

//                         $sql2 = "UPDATE `result` AS r 
//          JOIN `studentsem` AS s ON r.sid = s.sid
//          SET r.`$selectedOption` = '" . $rowData[$i][1] . "'
//          WHERE s.`semrollno` = '" . $rowData[$i][0] . "' 
//                AND r.`sem` = '" . $sem . "' 
//                AND r.`branch` = '" . $branch . "'  
//                AND r.`subject` = '" . $subject . "'";

//                         if ($conn->query($sql2) === TRUE) {
//                             echo "Record updated successfully";
//                         } else {
//                             echo "Error: " . $sql . "<br>" . $conn->error;
//                         }
//                         echo $rowData[$i][0];
//                         // echo "hello";
//                         // next($marks);
//                     }
//                     // $response = $tempresult;
//                 } else {
//                     $response = "sql error  ";
//                 }















//     } else {
//         $response = ['success' => false, 'message' => 'No file uploaded'];
//     }
// } else {
//     $response = ['success' => false, 'message' => 'Request method is not POST'];
// }

// // Output JSON response
// echo json_encode($response);

?>