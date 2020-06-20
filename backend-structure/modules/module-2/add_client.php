
 <?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn,$_POST['contact']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
        echo $address;
        // echo $role_id;
        

        $query = "INSERT INTO clients(client_name , email , contact , address , project_name) VALUES('$name' , '$email' , '$contact' , '$address' , '$project_name')";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/show_client.php');
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
    </style>

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
        <label>Name: </label><br>
        <input type="text" name="name" placeholder = "Enter name...">
        <br>
        <label>Email: </label><br>
        <input type="email" name="email" placeholder = "Enter email...">
        <br>
        <label>Contact </label><br>
        <input type="number" name="contact" placeholder = "Enter contact..." >
        <br>
        <label>Address </label><br>
        <input type="text" name="address" placeholder = "Enter address...">
        <br>
        <label>Project Name </label><br>
        <input type="text" name="project_name" placeholder = "Enter project name...">
        <br>
        <br>
        <button type="submit" name = "submit">Submit</button>
    </form>
</body>
</html>