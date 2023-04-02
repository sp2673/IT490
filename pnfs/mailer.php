<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function setMail($target, $flag) {

    switch ($flag){
        case 0: //RECEIVED A FRIEND REQUEST
            $content = "<b>You have recently received a friend request! Login to view.</b>";
            break;
        case 1: //ACCEPETED FRIEND REQUEST
            $content = "<b>Your friend request was accepted! Login to view.</b>";
            break;
        case 2: //2FA NOTIFICATION
            $content = generateRandomCode();
            $_SESSION['code'] = $content;
            break; 
    }

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
        $mail->Subject = "CRICKETDB";
        

        sendMail($mail, $content);

    } catch(Exception $e) {
        var_export($e);
        //$mail = null;
    }
}

function generateRandomCode($length = 6) {
    // FUNCTION TO GENERATE CODE
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
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