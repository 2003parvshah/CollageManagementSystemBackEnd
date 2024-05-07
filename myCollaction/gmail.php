<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require '../vendor/autoload.php';
class gmail
{
  public function sendmail($to , $subject , $message  , $attachmentPath = null)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true ;
    $mail->Username = 'ddustudy@gmail.com';
    $mail->Password  = 'juyhhwczepslrkaz';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; 
    $mail->setFrom('ddustudy@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML (true);
    $mail->Subject = $subject ;
    $mail->Body = $message ;
    
    // $mail->addAttachment('LT1.pdf');
    // $mail->addAttachment($attachmentPath);
    if($attachmentPath != NULL)
    {
    $mail->addAttachment($attachmentPath);
    echo($attachmentPath);
    }


    $mail->send();
   
    
    return "success";
   // }
}
}

?>