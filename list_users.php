<?php
    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }

    require_once("connection.php");  
    $query = "SELECT `userId`,`Full_Name`,`email`,`phone_Number`,`User_Name`,`UserType`,`Address` FROM users WHERE NOT UserType = 'super_user';";
    if($_SESSION['type'] == "administrator"){
        $query = "SELECT `userId`,`Full_Name`,`email`,`phone_Number`,`User_Name`,`UserType`,`Address` FROM users WHERE NOT UserType = 'super_user' AND UserType = 'administrator';";        
    }
    $result = $mysqli->query($query) OR die($mysqli->error);
    $all_property = array();

    //showing property
    echo '<tr class="data-heading">';  //initialize table tag
    while ($property = mysqli_fetch_field($result)) {
        echo '<td>' . $property->name . '</td>';  //get field name for header
        array_push($all_property, $property->name);  //save those to array
    }
    echo '</tr>'; //end tr tag

    //showing all data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        foreach ($all_property as $item) {
            echo '<td>' . $row[$item] . '</td>'; //get items using property value
        }
        echo '</tr>';
    }
    
?>