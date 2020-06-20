
 <?php
    require('include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $role_name = mysqli_real_escape_string($conn,$_POST['role_name']);
        $social_media = mysqli_real_escape_string($conn,$_POST['social_media']);
        echo $role_name;
        echo $social_media;

        // echo $role_id;

        $query = "INSERT INTO roles(role_name , social_media) VALUES('$role_name' , '$social_media')";

        if(mysqli_query($conn, $query)){
            header('Location: roles.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
       
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>

    <style>
        .form{
            border: 1px solid black;
            padding: 10px;
            width: 200px;
            display: flex;
            flex-direction:column;
            justify-content : center;
            margin:200px auto ;
        }

        .checkbox{
            display:inline;
        }


    </style>

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
        <label>Role Name </label><br>
        <input type="text" name="role_name" placeholder = "Enter role name...">
        <br>
        <input type="checkbox" name="social_media" class = "checkbox" value="1">Social Media Manager
        <br>
        <br>
        <button type="submit" name = "submit">Submit</button>
    </form>
</body>
</html>