<?php

// Include TCPDF library
// require_once('tcpdf/tcpdf.php');
// require_once 'vendor/autoload.php';
require '../vendor/autoload.php';


use Pdflib\Pdf;
// Function to generate PDF

function generateResultPDF($studentName, $rollNumber, $branch, $subjects) {
    // Create new PDF document
    $pdf = new TCPDF();

    // Set document properties
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('Student Result');
    $pdf->SetSubject('Result');
    $pdf->SetKeywords('TCPDF, PDF, result, student');

    // Add a page
    $pdf->AddPage();
 
    // Set font
    $pdf->SetFont('helvetica', '', 10);

    // Add student information
    $pdf->Cell(0, 10, "Student Name: $studentName", 0, 1);
    $pdf->Cell(0, 10, "Roll Number: $rollNumber", 0, 1);
    $pdf->Cell(0, 10, "Branch: $branch", 0, 1);

    // Add marks for each subject
    foreach ($subjects as $subject) {
        $pdf->Cell(0, 10, "Subject: {$subject['name']}", 0, 1);
        $pdf->Cell(0, 10, "Sessional: {$subject['sessional']}, Viva: {$subject['viva']}, Practical: {$subject['practical']}, Termwork: {$subject['termwork']}, External: {$subject['external']}", 0, 1);
    }

    // Output PDF as a file (download)
    $pdf->Output('student_result.pdf', 'D');
}

// Example usage
$studentName = "John Doe";
$rollNumber = "123456";
$branch = "Computer Science";
$subjects = array(
    array("name" => "Subject 1", "sessional" => 80, "viva" => 85, "practical" => 90, "termwork" => 88, "external" => 75),
    array("name" => "Subject 2", "sessional" => 75, "viva" => 82, "practical" => 87, "termwork" => 85, "external" => 80),
    array("name" => "Subject 3", "sessional" => 70, "viva" => 78, "practical" => 82, "termwork" => 80, "external" => 85)
);

// Generate PDF
// generateResultPDF($studentName, $rollNumber, $branch, $subjects);
$studentName = "John Doe";
$rollNumber = "123456";
$branch = "Computer Science";
$subjects = array(
    array("name" => "MATHEMATICS I", "sessional" => 33, "viva" => 32, "practical" => 0, "termwork" => 0, "external" => 65),
    array("name" => "BASIC ELECTRICAL ENGINEERING", "sessional" => 45, "viva" => 35, "practical" => 34, "termwork" => 0, "external" => 114),
    array("name" => "PROBLEM SOLVING PROGRAMMING I", "sessional" => 36, "viva" => 23, "practical" => 35, "termwork" => 0, "external" => 94),
    array("name" => "ENGINEERING GRAPHICS & DESIGN", "sessional" => 0, "viva" => 0, "practical" => 0, "termwork" => 78, "external" => 78),
    array("name" => "SOFTWARE WORKSHOP", "sessional" => 0, "viva" => 0, "practical" => 0, "termwork" => 38, "external" => 38)
);

// Generate PDF
generateResultPDF($studentName, $rollNumber, $branch, $subjects);



?>