
 <?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
		$client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
        $status = mysqli_real_escape_string($conn,$_POST['status']);
        echo $status;
        $amount = mysqli_real_escape_string($conn,$_POST['amount']);
        $amount_paid = mysqli_real_escape_string($conn,$_POST['amount_paid']);
        $amount_pending = mysqli_real_escape_string($conn,$_POST['amount_pending']);
        $start_date = mysqli_real_escape_string($conn,$_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn,$_POST['end_date']);
        $hosting_date = mysqli_real_escape_string($conn,$_POST['hosting_date']);
        echo $amount;
        // echo $role_id;

        $query = "SELECT staff_id FROM staff WHERE
                role_id = 1 LIMIT 1";
        echo $query;
         $result = mysqli_query($conn,$query);
         if ($result !== false){
            $row = mysqli_fetch_array($result);
            $staff_admin_id = $row[0];
         }
         echo $staff_admin_id;
         mysqli_free_result($result);
        

        $query = "INSERT INTO projects(project_name , client_name , status , amount , amount_received , amount_pending , start_date , end_date , hosting_date , staff_admin_id) 
        VALUES('$project_name' , '$client_name' , '$status' , '$amount' , '$amount_paid', '$amount_pending' ,'$start_date' ,'$end_date' , '$hosting_date' , '$staff_admin_id' )";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/show_project.php');
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
        
        <input type="text" name="project_name" placeholder = "Enter Project name...">
        <br>
        <input type="text" name="client_name" placeholder = "Enter Client name...">
        <br>
        <select name="status" id="">
        <option value="to do">To Do</option>
        <option value="ongoing">Ongoing</option>
        <option value="done">Done</option>
        </select>
        <br>
        <input type="number" name="amount" placeholder = "Enter Amount...">
        <br>        
        <input type="number" name="amount_paid" placeholder = "Enter Amount paid...">
        <br>
        <input type="number" name="amount_pending" placeholder = "Enter Amount pending...">
        <br>
        <input type="text" name="start_date" placeholder = "Enter Start Date...">
        <br>
        <input type="text" name="end_date" placeholder = "Enter End Date...">     
        <br> 
        <input type="text" name="hosting_date" placeholder = "Enter Hosting Date...">
        <br>
        <button type="submit" name = "submit">Submit</button>
        <br>
        <button type="submit" name = "submit">Assign Tasks</button>
    </form>
</body>
</html>