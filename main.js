$(document).ready(function () {
    profileTab();
    manageOtherTab();

    $("#imageForm").submit(false);

});

function profileTab() {
    $("#update_profile").click(function () {
        $("#updateProfileTab").toggle();
        $("#updateProfileTab").siblings().hide();


        disableChanges();
        var image_path = "";
        $.post("fetch_details.php", function (data) {
            $("#full_name").val(data[1]);
            $("#email").val(data[2]);
            $("#phone_number").val(data[3]);
            $("#username").val(data[4]);
            $("#password").val(data[5]);
            $("#usertype").val(data[6]);
            $("#address").val(data[9]);

            image_path = data[8];
            if (image_path == "null") {
                image_path = "profile.png";
            }
            $(".image img").attr("src", image_path);

        }, "json").fail(function () {
            console.log("Error with fetch");

        });
    });

    $("#edit").click(function (e) {
        e.preventDefault();
    });

    $("#edit").clickToggle(function () {
        enableChanges();
    }, function () {
        disableChanges();
    });

    //Update changes made
    $("#save_changes").on('click', function (e) {
        e.preventDefault();
        //Check fields are not empty
        var formdata = $("#profile").serializeArray();
        var emptyField = false;
        $.each(formdata, function (index, val) {
            if (!val['value'] || val['value'] == "") {
                emptyField = true;
                return;
            }
        });
        if (emptyField) {
            $("#message").html("<p>All fields must be filled</p>");
        } else {
            $("#message").html(" ");
            var path = $(".image img").attr("src");
            formdata[5] = { "name": "profile-image", "value": path };

            $.post("update_details.php", formdata, function (data) {
                console.log(data);

            }).done(function () {
                disableChanges();

            }).fail(function () {
                console.log("Error in update");
            });
        }
    });
}

function manageOtherTab() {
    $("#manageOther").on('click', function () {
        $("#manageOtherTab").toggle();
        $("#manageOtherTab").siblings().hide();    
    });

    //Add users tab toggle
    $("#addUser").on('click', function () {
        $("#addUserTab").toggle()
        $("#addUserTab").siblings().hide();
    });

    //choosing image to upload
    $(".imageManage, #add_imageInstruct").on('click', function () {
        $("#add_image").trigger('click').on('change', function () {

            var file = this.files[0];
            var name = file.name;
            var size = file.size;
            var type = file.type.split('/').pop().toLowerCase();;

            var errors = "";
            //EXtension validation
            var accepted_ext = ['jpeg', 'png', 'jpg'];
            var valid = $.inArray(type, accepted_ext);
            if (valid == -1) {
                errors += "<p>Please select jpg or png </p>";
            } else if (size > 2097152) {
                errors += "<p>Image should be less than 2MB</p>";
            } else {
                var myForm = $("#imageForm");

                var imageData = new FormData();
                imageData.append("profile-image", file);
                var new_path = "";

                $.ajax({
                    url: "image_change.php",
                    type: "POST",
                    data: imageData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        new_path = data;
                    },
                    error: function () {
                        console.log("Error");
                    }

                }).done(function () {
                    $(".imageManage>img").attr('src', new_path);
                });
            }
            $("#add_ImageInstruct").html(errors);

        });

    });

    //Save new user
    $("#add_user").on('click', function (e) {
        e.preventDefault();
        var userForm = $("#newUserForm");
        var newUser = userForm.serializeArray();

        var path = $(".imageManage>img").attr("src");
        newUser.push({ "name": "profile-image", "value": path });

        $.post("insert_details.php", newUser, function (data) {
            console.log(data);
            $("#successMessage").html("<p>"+data+"</p>");
        }).fail(function () {
            console.log("Error in update");
        }).done(function () {
            $("#newUserForm").children().find("input[type='text'],[type='email']").val(" ");
            $(".imageManage>img").attr('src', "profile.png");
        });

    });

    //Toggle list users tab
    $("#listUsers").on('click',function(){
        $("#listUsersTab").toggle().siblings().hide();
    
        $.post("list_users.php",function(data){
            $(".users-table").html(data);
        });
    });

    //Toggle update user tab
    $("#updateUser").on('click',function(){
        $("#updateUserTab").toggle().siblings().hide();
    });

    //Show searched user
    $("#searchForm,#profileSearched,deleteForm").submit(false);
    $("#search_btn").on('click', function(){
        var q = $("#searchq").val();
        var send = {"query": q};

        if(q !== "enforcer"){   
            var image_path = "";
            var response = new Array() ;
            $.post("fetch_update.php",send,function(data){                
                response = data;         
                
            },"JSON").done(function(){
                $("#ouserId").val(response[0]);
                $("#ofull_name").val(response[1]);
                $("#oemail").val(response[2]);
                $("#ophone_number").val(response[3]);
                $("#ousername").val(response[4]);
                $("#opassword").val(response[5]);
                $("#ousertype").val(response[6]);
                $("#oaddress").val(response[9]);

                image_path = response[8];
                if (image_path == "null") {
                    image_path = "profile.png";
                }
                $(".imageOther img").attr("src", image_path);
                
                $("#search_results").show();
                disableChanges();
                
                //Save changes on updated user
                $("#save").on('click', function () {
                    console.log("Hello");

                    //Check fields are not empty
                    var formdata = $("#profileSearched").serializeArray();
                    var emptyField = false;
                    $.each(formdata, function (index, val) {
                        if (!val['value'] || val['value'] == "") {
                            emptyField = true;
                            return;
                        }
                    });
                    if (emptyField) {
                        $("#oupload_error").html("<p>All fields must be filled</p>");
                    } else {
                        $("#oupload_error").html(" ");
                        var path = $(".imageOther img").attr("src");
                        formdata[6] = { "name": "profile-image", "value": path };
                        console.log(formdata);


                        $.post("update_user.php", formdata, function (data) {
                            console.log(data);

                        }).done(function () {
                            disableChanges();

                        }).fail(function () {
                            console.log("Error in update");
                        });
                    }
                });

            }).fail(function(){
                console.log("Error in fetch");                
            });
        }
    });

    //Some support features
    $("#oedit").on('click', function (e) {
        e.preventDefault();
    });

    $("#oedit").clickToggle(function () {
        enableChanges();
    }, function () {
        disableChanges();
    });

    //Toggle delete user tab
    $("#deleteUser").on('click', function () {
        $("#deleteUserTab").toggle().siblings().hide();
    });

    //Delete user
    $("#delete_btn").on('click',function(e){
        e.preventDefault();
        var q = $("#deleteq").val();
        var send = {'userId':q};
        $.post("delete_user.php",send,function(data){
            console.log(data);
            $("#dresult").html("<p>"+data+"</p>");
        });
    });

}

function disableChanges() {
    $(".profile, #save_changes,#osave_changes").prop("disabled", true).css({
        "cursor": "not-allowed"
    });
}

function enableChanges() {
    $(".profile").prop("disabled", false).css({
        "cursor": "text"
    });
    $("#save_changes,#osave_changes").prop("disabled", false).css({
        "cursor": "pointer"
    });;
    $("#profile #username,#profile #usertype").prop("disabled", true).css({
        "cursor": "not-allowed"
    });;

    $(".image img").on('click', function () {
        var isEnabled = $("#save_changes").prop("disabled");
        if (!isEnabled) {
            //Trigger choosing a file
            $("#profile-image").trigger('click');

            $("#profile-image").change(function () {
                var file = this.files[0];
                var name = file.name;
                var size = file.size;
                var type = file.type.split('/').pop().toLowerCase();;

                var errors = "";
                //EXtension validation
                var accepted_ext = ['jpeg', 'png', 'jpg'];
                var valid = $.inArray(type, accepted_ext);
                if (valid == -1) {
                    errors += "<p>Please select jpg or png </p>";
                } else if (size > 2097152) {
                    errors += "<p>Image should be less than 2MB</p>";
                } else {
                    var myForm = $("#imageForm");

                    var imageData = new FormData();
                    imageData.append("profile-image", file);
                    var new_path = "";

                    $.ajax({
                        url: "image_change.php",
                        type: "POST",
                        data: imageData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            new_path = data;
                        },
                        error: function () {
                            console.log("Error");
                        }

                    }).done(function () {
                        $(".image>img").attr('src', new_path);
                    });
                }
                $("#upload_error").html(errors);

            });
        }
    });

    //For update user
    $(".imageOther img").on('click', function () {
        var isEnabled = $("#ofull_name").prop("disabled");
        if (!isEnabled) {
            //Trigger choosing a file
            $("#profile-image").trigger('click');

            $("#profile-image").change(function () {
                var file = this.files[0];
                var name = file.name;
                var size = file.size;
                var type = file.type.split('/').pop().toLowerCase();;

                var errors = "";
                //EXtension validation
                var accepted_ext = ['jpeg', 'png', 'jpg'];
                var valid = $.inArray(type, accepted_ext);
                if (valid == -1) {
                    errors += "<p>Please select jpg or png </p>";
                } else if (size > 2097152) {
                    errors += "<p>Image should be less than 2MB</p>";
                } else {
                    var myForm = $("#imageForm");

                    var imageData = new FormData();
                    imageData.append("profile-image", file);
                    var new_path = "";

                    $.ajax({
                        url: "image_change.php",
                        type: "POST",
                        data: imageData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            new_path = data;
                        },
                        error: function () {
                            console.log("Error");
                        }

                    }).done(function () {
                        $(".imageOther>img").attr('src', new_path);
                    });
                }
                $("#oupload_error").html(errors);

            });
        }
    });
}

//Function toggler
$.fn.clickToggle = function (a, b) {
    function cb() { [b, a][this._tog ^= 1].call(this); }
    return this.on("click", cb);
};