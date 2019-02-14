<?php
  session_start();

  if(isset($_FILES['profile-image'])){
          
    $target = "images/".uniqid("user_".$_SESSION['id']."_");
    $file_name = $_FILES['profile-image']['name'];
    $file_size =$_FILES['profile-image']['size'];
    $file_tmp =$_FILES['profile-image']['tmp_name'];
    $file_type=$_FILES['profile-image']['type'];
    $tmp = explode('.',$file_name);
    $file_ext=strtolower(end($tmp)); 
    
    $extensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)=== false){
      $errors .="extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152){
      $errors .='File size must be exactly 2 MB';
    }
    
    $final_file = ($target.$file_name);
    if (!isset($errors)) {
        if(move_uploaded_file($file_tmp,$final_file)){
            echo $final_file;
        }  
    }
          
          
  }
?>