<?php
    include ("constant.php");

    //Create a database connection
    $mysqli = new mysqli(Host_Name,Database_User,Password,Database_Name);
    
    if ($mysqli == false) {
            die("There was an error in connection");
        }
?>