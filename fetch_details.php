<?php
    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }
    

    require_once("connection.php");

    $userId = $_SESSION['id'];

    $query = "SELECT * FROM `users` WHERE `userId` = '$userId' ; ";
    $result = $mysqli->query($query) OR die($mysqli->error);

    if($result->num_rows > 0){
        $row = $result->fetch_array(3);

        echo json_encode($row);
        exit();
    }
    
?>