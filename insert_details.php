<?php

    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }

    require_once("connection.php");  

    $full_name = $mysqli->real_escape_string($_POST['full_name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $phone_number = $mysqli->real_escape_string($_POST['phone_number']);
    $username = $mysqli->real_escape_string($_POST['username']);
    $usertype = $mysqli->real_escape_string($_POST['usertype']);
    $password = $mysqli->real_escape_string($_POST['password']);
    $image = $mysqli->real_escape_string($_POST['profile-image']);
    $address = $mysqli->real_escape_string($_POST['address']);

    $query = "INSERT INTO `users`(`Full_Name`, `email`, `phone_Number`,
             `User_Name`, `Password`, `UserType`, `Image`, `Address`) 
              VALUES ('$full_name','$email','$phone_number','$username','$password',
              '$usertype','$image','$address');";
    $result = $mysqli->query($query) OR die($mysqli->error);

    if($result){
        echo "Successful update";
    }else{
        echo "Error in update";
    }
?>