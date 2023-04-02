<?php
require '../pnfs/mailer.php';
require 'includes/init.php';

include 'includes/ChromePhp.php';

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}



// PROFILE REDIRECT FUNCTION
function redirect_to_profile(){
    header('Location: profile.php');
    exit;
}
// IF GET ACTION AND ID PARAMETERS
if(isset($_GET['action']) && isset($_GET['id'])){
    // CHEKC USER LOGGED IN OR NOT || IF USER LOGGED IN
    if(isset($_SESSION['user_id']) && isset($_SESSION['email'])){


        // USER DATA TO REACH EMAIL AND ID
        // $user_data = $user_obj->find_user_by_id($_SESSION['user_id']);


        // IF PARAMETER ID IS EQUAL TO MY ID($_SESSION['user_id']) THEN REDIRECT TO PROFILE
        if($_GET['id'] == $_SESSION['user_id']){
            redirect_to_profile();
        }
        // OTHERWISE DO THIS
        else{
            // ASSIGN TO VARIABLE 
            $user_id = $_GET['id'];
            $my_id = $_SESSION['user_id'];

            // TO SEND EMAIL TO CORRECT PERSON
            if (isset($_GET['email'])){
                $user_email = $_GET['email'];
            }

            // IF GET SEND REQUEST ACTION
            if($_GET['action'] == 'send_req'){
                // CHECK IS REQUEST ALREADY SENT OR NOT
                // is_request_already_sent() FUNCTION RETURN TRUE OR FLASE
                if($frnd_obj->is_request_already_sent($my_id, $user_id)){
                    redirect_to_profile();
                }
                // CHECK IF THIS ID IS ALREADY IN MY FRIENDS LIST.
                // THIS FUNCTION ALSO RETURN TRUE OR FLASE 
                elseif($frnd_obj->is_already_friends($my_id, $user_id)){
                    redirect_to_profile();
                }
                // OTHERWISE MAKE FRIEND REQUEST
                else{     
                    setMail($user_email, 0); // add "someone sent you a request"
                    $frnd_obj->send_frnd_req($my_id, $user_id, $user_email);
                }
            }
            // IF GET CANCEL REQUEST OR IGNORE REQUEST ACTION
            else if($_GET['action'] == 'cancel_req' || $_GET['action'] == 'ignore_req'){
                $frnd_obj->cancel_or_ignore_friend_request($my_id, $user_id, $user_email);
                redirect_to_profile();
            }
            // IF GET ACCEPT REQUEST ACTION
            elseif($_GET['action'] == 'accept_req'){

                if($frnd_obj->is_already_friends($my_id, $user_id)){
                    redirect_to_profile();
                }
                else{
                    setMail($user_email, 1);
                    $frnd_obj->make_friends($my_id, $user_id, $user_email);
                }
            }
            // IF GET UNFRIEND REQUEST ACTION
            elseif($_GET['action'] == 'unfriend_req'){
                $frnd_obj->delete_friends($my_id, $user_id, $user_email);
            }
            else{
                redirect_to_profile();
            }
        }
    }
    else{
        header('Location: logout.php');
        exit;
    }
}
else{
    redirect_to_profile();
}