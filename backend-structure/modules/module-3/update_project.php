<?php
    require('../../include/common/config.php');

    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
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
        
        $query = "UPDATE projects SET 
                    project_name='$project_name',
                    client_name = '$client_name',
                    status='$status',
                    amount='$amount',
                    amount_received = '$amount_paid',
                    amount_pending = '$amount_pending',
                    start_date = '$start_date',
                    end_date = '$end_date',
                    hosting_date = '$hosting_date'
            WHERE project_id = {$update_id}";

        if(mysqli_query($conn, $query)){
			header('Location:  http://localhost/Timesheet/backend-structure/show_project.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    }

    if(isset($_GET['id'])){
        try{
          $id = mysqli_real_escape_string($conn, $_GET['id']);
      
          $query = 'SELECT * FROM projects WHERE project_id = '.$id;
      
          $result = mysqli_query($conn, $query);
          
          // Fetch Data
          $project = mysqli_fetch_assoc($result);
          var_dump($project);
      
          // Free Result
          mysqli_free_result($result);
      
          // Close Connection
          mysqli_close($conn);
        }catch(Exception $e) { 
          echo "\n Exception Caught", $e->getMessage();
        }
      }else{
          echo 'Something went wrong';
          exit;
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
        <input type="text" name="project_name" placeholder = "Enter Project name..." value = "<?php echo $project['project_name'];?>">
        <br>
        <input type="text" name="client_name" placeholder = "Enter Client name..."  value = "<?php echo $project['client_name'];?>">
        <br>
        <select name="status" id=""  value = "<?php echo $project['status'];?>">
        <option value="to do">To Do</option>
        <option value="ongoing">Ongoing</option>
        <option value="done">Done</option>
        </select>
        <br>
        <input type="number" name="amount" placeholder = "Enter Amount..."  value = "<?php echo $project['amount'];?>">
        <br>        
        <input type="number" name="amount_paid" placeholder = "Enter Amount paid..."  value = "<?php echo $project['amount_received'];?>">
        <br>
        <input type="number" name="amount_pending" placeholder = "Enter Amount pending..."  value = "<?php echo $project['amount_pending'];?>">
        <br>
        <input type="text" name="start_date" placeholder = "Enter Start Date..."  value = "<?php echo $project['start_date'];?>">
        <br>
        <input type="text" name="end_date" placeholder = "Enter End Date..."  value = "<?php echo $project['end_date'];?>">     
        <br> 
        <input type="text" name="hosting_date" placeholder = "Enter Hosting Date..."  value = "<?php echo $project['hosting_date'];?>">
        <br>
        <button type="submit" name = "submit">Submit</button>
        <input type="hidden" name="update_id" value="<?php echo $project['project_id']; ?>">
        <br>
        <button type="submit" name = "submit">Assign Tasks</button>
    </form>
</body>
</html>




