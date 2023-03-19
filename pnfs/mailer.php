<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


function alertFriend($target){
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
        $mail->Subject = "Friend Request!";
        $content = "<b>You have recently received a friend request! Login to view.</b>";

        sendMail($mail, $content);

    } catch(Exception $e) {
        var_export($e);
        //$mail = null;
    }
}

function alertAccept($target) {
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
        $mail->Subject = "New Friend!";
        $content = "<b>Your friend request was accepted! Login to view.</b>";

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