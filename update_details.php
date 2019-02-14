<?php

    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }

    require_once("connection.php");  

    $userId = $mysqli->real_escape_string($_SESSION['id']);
    $full_name = $mysqli->real_escape_string($_POST['full_name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone_number = $mysqli->real_escape_string($_POST['phone_number']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $image = $mysqli->real_escape_string($_POST['profile-image']);
    $address = $mysqli->real_escape_string($_POST['address']);

    $query = "UPDATE `users` SET 
            `Full_Name`='$full_name',
            `email`='$email',
            `phone_Number`= '$phone_number',
            `Password`='$password',
            `Image`='$image',
            `Address`='$address' 
            WHERE userId = '$userId' ;";
    $result = $mysqli->query($query) OR die($mysqli->error);

    if($result){
        echo "Successful update";
    }else{
        echo "Error in update";
    }
?>