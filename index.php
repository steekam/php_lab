<?php

    session_start();

    if (array_key_exists("logout",$_GET) AND isset($_GET['logout'])) {
        $helper = array_keys($_SESSION);
        foreach ($helper as $key){
            unset($_SESSION[$key]);
        }
    }

    if (array_key_exists("type",$_SESSION) AND isset($_SESSION['type'])) {
        $type = $_SESSION['type'];
        if ($type == "super_user") {
            header("Location: home_su.php");
        }else if($type == "administrator"){
            header("Location: home_admin.php");
        }
    }

    require_once("connection.php");

        $error_msg=" ";
    if (array_key_exists("button",$_POST) AND isset($_POST['button'])) {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $mysqli->real_escape_string($_POST['password']);

        $query = "SELECT `userId`, `password`, `UserType` FROM users WHERE `User_Name` ='$username';";
        $result =  $mysqli->query($query) OR die($mysqli->error);

        if ($result->num_rows > 0) {
            $row = $result->fetch_array(1);
            $saved_pass = $row['password'];            

            if ($saved_pass == $password) {
                //Create a session id
                $_SESSION['id'] = $row['userId'];

                $type = $row['UserType'];
                if ($type == "super_user") {
                    header("Location: home_su.php");
                    $_SESSION['type'] = "super_user";
                }else if($type == "administrator"){
                    $_SESSION['type'] = "admin";
                    header("Location: home_admin.php");
                }else {
                    $error .= "<p>You don't have permission to login</p>";
                }

            }else{
                $error_msg .= "<p>Password is incorrect.</p>";
            }
        }else{
            $error_msg .= '<p>Username does not exist</p>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <style>
        form{
            width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <form method="post">
    <div id="message">
        <?php
           echo $error_msg;
        ?>
    </div>

    <fieldset>
    <legend>Login</legend>

    Username: <input type="text" name="username" id="username"> <br>
    Password: <input type="password" name="password" id="password"> <br>
    <input type="submit" name="button" value="Login">

    </fieldset>
    
    </form>
</body>
</html>