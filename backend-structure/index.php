
 <?php
    require('include/common/config.php');

    // if(isset($_GET['submit'])){
    //     try{
    //       $id = mysqli_real_escape_string($conn, $_GET['submit']);
    //       echo $id;
      
    //       $sql = 'SELECT * FROM staff WHERE staff_id = '.$id;
    //       echo $sql;
            
    //       $result = mysqli_query($conn, $query);
          
    //       // Fetch Data
    //       $staff = mysqli_fetch_assoc($result);
    //       var_dump($staff);
      
    //       // Free Result
    //       mysqli_free_result($result);
      
    //       // Close Connection
    //       mysqli_close($conn);
    //     }catch(Exception $e) { 
    //       echo "\n Exception Caught", $e->getMessage();
    //     }
    //   }else{
    //       echo 'Something went wrong';
    //       exit;
    //   }



    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $staff_id = mysqli_real_escape_string($conn, $_POST['staff_id']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        // echo $role_id;
     

    $query = "SELECT * FROM staff";
        echo $query;
         $result = mysqli_query($conn,$query);
         $employees = mysqli_fetch_all($result , MYSQLI_ASSOC);
         var_dump($employees);
         $count = mysqli_num_rows($result);
         mysqli_free_result($result);

         foreach($employees as $employee){
            if (($email===$employee['email']) && ($password === $employee['password'] && $employee['role_id'] == 1)) {
                header( "location: http://localhost/Timesheet/backend-structure/modules/module-3/dashboard.php");
            } elseif(($email===$employee['email']) && ($password === $employee['password'])) {
                header( "location: http://localhost/Timesheet/backend-structure/show_client.php");
            }else{
                echo 'invalid credentials'; 
            }
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
        <input type="hidden" name="staff_id" value="<?php echo $staff['staff_id']; ?>">
        <button type="submit" name = "submit">Submit</button>
    </form>
</body>
</html>