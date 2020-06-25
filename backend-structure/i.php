
 <?php
    require('include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        // echo $role_id;
    } 

    $query = "SELECT * FROM staff";
        echo $query;
         $result = mysqli_query($conn,$query);
         $employees = mysqli_fetch_all($result , MYSQLI_ASSOC);
         $count = mysqli_num_rows($result);
         mysqli_free_result($result);

         foreach($employees as $employee){
            if (($email===$employee['email']) && ($password === $employee['password'] && $employee['role_id'] == 1)) {
                header( "location: http://localhost/Timesheet/backend-structure/roles.php");
            } elseif(($email===$employee['email']) && ($password === $employee['password'])) {
                header( "location: http://localhost/Timesheet/backend-structure/show_client.php");
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
        <label>Email: </label><br>
        <input type="email" name="email" placeholder = "Enter email...">
        <br>
        <label>password </label>
        <input type="password" name="password" placeholder = "Enter password...">
        <br>
        <br>
        <input type="hidden" name="staff_id" value="<?php echo $employees['staff_id']; ?>">
        
        <button type="submit" name = "submit">Submit</button>
    </form>
</body>
</html>