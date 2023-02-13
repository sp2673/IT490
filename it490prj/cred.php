<?php
function getCred(){
    global $servername;
    global $user;
    global $passwd;

    return array($servername, $user, $passwd);
}
?>