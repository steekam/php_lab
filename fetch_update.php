<?php
    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }
    

    require_once("connection.php");

    $q = $_POST['query'];

    $query = "SELECT * FROM `users` WHERE `User_Name` = '$q' ; ";
    $result = $mysqli->query($query) OR die($mysqli->error);

    if($result->num_rows > 0){
        $row = $result->fetch_array(3);

        echo json_encode($row);
        exit();
    }
    
?>