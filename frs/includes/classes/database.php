<?php 
class Database 
{
    function dbConnection()
    {
        $db_host = "localhost"; //temporary must change to dbhost ip
        $db_name = "friendSystem";
        $db_username = "root";
        $db_password = "";

        $curr_db = 'mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8';
        try{
            $site_db = new PDO($curr_db, $db_username, $db_password);
            $site_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $site_db;

         }catch (PDOException $e){
            echo $e->getMessage();
            exit;
         }
    }
}
?>