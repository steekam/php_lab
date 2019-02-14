<?php 
    session_start();
    if (!(array_key_exists("id",$_SESSION) AND isset($_SESSION['id']))) {
        header("Location: index.php");        
    }

    if (array_key_exists("type",$_SESSION) AND isset($_SESSION['type'])) {
        $type = $_SESSION['type'];        
        if ($type == "super_user") {
            header("Location: home_su.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="menu">
        <button id="update_profile">Update Profile</button>
        <button id="manageOther">Manage students</button>
       <a href="index.php?logout=1"><button>Log out</button></a>
    </div>

    <div id="container">
        <div id="updateProfileTab" class="hidden">
            <div id="message">
            </div>  

            <form class="hidden" method="post" id="imageForm" enctype="multipart/form-data">
                <input type="file" class="hidden"  name="profile-image" id="profile-image">
                <input id="upload_image" type="submit" value="upload">
            </form> 

            <form id="profile" method="post">
                <fieldset>
                    <legend>Profile</legend>
                    
                    <button id="edit">EDIT DETAILS</button>            

                    <div class="image">
                        <img src="profile.png" alt="profile-image">
                    </div>
                    <div id="upload_error"></div>

                    FULL NAME <br>
                    <input class="form-data profile" type="text" name="full_name" id="full_name" required> <br>
                    EMAIL <br>
                    <input class="form-data profile" type="email" name="email" id="email" required> <br>
                    PHONE NUMBER <br>
                    <input class="form-data profile" type="text"  name="phone_number" id="phone_number" required> <br>
                    USERNAME <br>
                    <input class="form-data profile" type="text" name="username" id="username" required> <br>
                    PASSOWRD <br>
                    <input class="form-data profile" type="text" name="password" id="password" required> <br>
                    USER TYPE <br>
                    <input class="form-data profile" type="text" name="usertype" id="usertype" required> <br>
                    ADDRESS <br>
                    <input class="form-data profile" type="text" name="address" id="address" required> <br>

                    <input type="submit" value="SAVE CHANGES" id="save_changes">
                </fieldset>      
            </form>

        </div>

        <div id="manageOtherTab" class="hidden">
            <div id="manage_menu">
                <button id="addUser" >Add student</button>        
                <button id="listUsers" >List student</button>        
                <button id="updateUser" >Update student</button>        
                <button id="deleteUser" >Delete student</button>        
            </div>

            <div class="container">
                <div id="addUserTab" class="hidden" >
                    <form id="newUserForm" method="post">
                        <fieldset>
                            <legend>Add new student</legend>
                            <div id="successMessage"></div>
                            <div class="imageManage">
                                <img class="display" src="profile.png" alt="Add image">
                            </div>
                            <div id="add_imageInstruct">Click to add image</div>

                                <input class="hidden" type="file" name="add_image" id="add_image">

                            FULL NAME <br>
                            <input class="form-data" type="text" name="full_name" id="full_name" required> <br>
                            EMAIL <br>
                            <input class="form-data" type="email" name="email" id="email" required> <br>
                            PHONE NUMBER <br>
                            <input class="form-data" type="text"  name="phone_number" id="phone_number" required> <br>
                            USERNAME <br>
                            <input class="form-data" type="text" name="username" id="username" required> <br>
                            PASSOWRD <br>
                            <input class="form-data" type="text" name="password" id="password" required> <br>
                            USER TYPE <br>
                            <select class="form-data" name="usertype" id="usertype">
                                <option value="student">student</option>
                            </select> <br>
                            ADDRESS <br>
                            <input class="form-data" type="text" name="address" id="address" required> <br>

                            <input type="submit" value="ADD NEW USER" id="add_user">
                        </fieldset>      
                    </form>
                </div>

                <div id="listUsersTab" class="hidden" >
                    <table class="users-table">                        
                    </table>
                </div>

                <div id="updateUserTab" class="hidden" >
                    <form  method="post" id="searchForm">
                        <input class="form-data" type="text" name="q" id="searchq" placeholder="Enter username">
                        <input type="submit" value="SEARCH" name="search" id="search_btn">                        
                    </form>
                    <div id="search_results" class="hidden" style="margin-top: 10px;">

                        <form id="profileSearched" method="post">
                            <fieldset>
                                <legend>Profile</legend>
                                
                                <button id="oedit">EDIT DETAILS</button>            

                                <div class="imageOther">
                                    <img class= "display" src="profile.png" alt="profile-image">
                                </div>
                                <div id="oupload_error"></div>
                                
                                <input type="hidden" name="userId" id="ouserId">

                                FULL NAME <br>
                                <input class="form-data profile" type="text" name="full_name" id="ofull_name" required> <br>
                                EMAIL <br>
                                <input class="form-data profile" type="email" name="email" id="oemail" required> <br>
                                PHONE NUMBER <br>
                                <input class="form-data profile" type="text"  name="phone_number" id="ophone_number" required> <br>
                                USERNAME <br>
                                <input class="form-data profile" type="text" name="username" id="ousername" required> <br>
                                PASSOWRD <br>
                                <input class="form-data profile" type="text" name="password" id="opassword" required> <br>
                                USER TYPE <br>
                                <input class="form-data profile" type="text" name="usertype" id="ousertype" required> <br>
                                ADDRESS <br>
                                <input class="form-data profile" type="text" name="address" id="oaddress" required> <br>
                                <button id="save">SAVE</button>
                            </fieldset>      
                        </form>

                    </div>
                </div>

                <div id="deleteUserTab" class="hidden" >
                    <form  method="post" id="deleteForm">
                        <input class="form-data" type="text" name="q" id="deleteq" placeholder="Enter userId">
                        <input type="submit" value="DELETE" name="delete" id="delete_btn">                        
                    </form>
                    <div id="dresult"></div>
                </div>
            </div>
        
        </div>
    </div>
    
    <script src="jquery.js"></script>
    <script src="main.js"></script>
</body>
</html>