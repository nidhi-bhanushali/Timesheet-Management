
 <?php
    require('include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $role_name = mysqli_real_escape_string($conn,$_POST['role_name']);
        echo $role_name;

        // echo $role_id;
    } 

    $query = "SELECT email , password FROM staff";
        echo $query;
         $result = mysqli_query($conn,$query);
         $employees = mysqli_fetch_all($result , MYSQLI_ASSOC);
         var_dump($employees);
         mysqli_free_result($result);

    
    $query = "SELECT * FROM roles";
    
    $result = mysqli_query($conn,$query);

    $roles = mysqli_fetch_all($result , MYSQLI_ASSOC);
    var_dump($roles);

    mysqli_free_result($result);

    

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
        <select id="roles" name="role_name">
        <?php
        foreach($roles as $role_name){
            $role_name = $role_name['role_name'];
            echo "<option>Choose role</option>";
            echo "<option value = '$role_name'>$role_name</option>";
        }
        ?>
        </select>
        <br>
        <label>password </label>
        <input type="password" name="password" placeholder = "Enter password...">
        <br>
        <br>
        <button type="submit" name = "submit"><a href="<?php echo 'http://localhost/Timesheet/backend-structure';?>i.php"></a>Submit</button>
    </form>
</body>
</html>