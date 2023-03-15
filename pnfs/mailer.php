<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function getMailer(){
    try {
        $mail = new PHPMailer(true); 

        //From address
        $mail->From = "auto@cricket.com";
        $mail->FromName = "CricketWeb";
        $mail->addReplyTo("noreply@yourdomain.com", "Reply"); //no reply

    } catch(Exception $e) {
        var_export($e);
        $mail = null;
    }
    return $mail;
}


function sendMail($target){
    $mail = getMailer();
    $mail->addAddress($target);
    $mail = getMessage($mail);

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }

}

function getMessage($mail){

    $subject = "Test";
    $body = "<i>This is a test message</i>";
    $altBody = "Message sent";
    
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = $altBody;

    return $mail;
}
?>