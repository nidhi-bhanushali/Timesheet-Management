
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

    $query = "SELECT staff_id FROM staff WHERE email = '$email' and password = '$password'";
        echo $query;
         $result = mysqli_query($conn,$query);
         $employees = mysqli_fetch_all($result , MYSQLI_ASSOC);
         var_dump($employees);
         $count = mysqli_num_rows($result);
         mysqli_free_result($result);

         if($count == 1) {
            header("location: http://localhost/Timesheet/backend-structure/show_project.php");
         }else {
            $error = "Your Login Name or Password is invalid";
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