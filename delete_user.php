<?php
    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }
    

    require_once("connection.php");

    $userId = $_POST['userId'];

    $query = "DELETE  FROM `users` WHERE `userId` = '$userId' AND `userId` != 1 ; ";
    $result = $mysqli->query($query) OR die($mysqli->error);

    if($result){
        echo "Succesful delete";
    }
        exit();   
?>