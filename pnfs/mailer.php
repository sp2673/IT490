<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


function setMailer($target){
    try {
        $mail = new PHPMailer(true); 

        //Settings
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->CharSet = 'UTF-8';

        //From address
        $mail->SMTPDebug  = 1;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587; // 587
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "it490mailer@gmail.com";
        $mail->Password   = "whwvlwlmotnqtqub";

        $mail->IsHTML(true);
        $mail->AddAddress($target, "recipient-name");
        $mail->SetFrom("it490mailer@gmail.com", "it490mailer");
        $mail->AddReplyTo("it490mailer@gmail.com", "it490mailer");
        $mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
        $content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

        sendMail($mail, $content);

    } catch(Exception $e) {
        var_export($e);
        //$mail = null;
    }
}


function sendMail($mail, $content){
    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo "Email sent successfully";
    }
}