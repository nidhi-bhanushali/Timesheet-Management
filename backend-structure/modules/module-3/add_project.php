
 <?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
		$client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
        $status = mysqli_real_escape_string($conn,$_POST['status']);
        //echo $status;
        $amount = mysqli_real_escape_string($conn,$_POST['amount']);
        $amount_paid = mysqli_real_escape_string($conn,$_POST['amount_paid']);
        $amount_pending = mysqli_real_escape_string($conn,$_POST['amount_pending']);
        $start_date = mysqli_real_escape_string($conn,$_POST['start_date']);
        $end_date = mysqli_real_escape_string($conn,$_POST['end_date']);
        $hosting_date = mysqli_real_escape_string($conn,$_POST['hosting_date']);
        //echo $amount;

        // File upload
        $fileName2 = rand(100,1000)."-".$_FILES['file1']['name'];
        
        $tname = $_FILES['file1']['tmp_name'];
        $upload_dir = 'C:/xampp1/htdocs/Timesheet/backend-structure/uploads2'; 
        move_uploaded_file($tname , $upload_dir.'/'.$fileName2);
        // echo $role_id;


        // get admin's staff id 
        $query = "SELECT staff_id FROM staff WHERE
                role_id = 1 LIMIT 1";
        echo $query;
         $result = mysqli_query($conn,$query);
         if ($result !== false){
            $row = mysqli_fetch_array($result);
            $staff_admin_id = $row[0];
         }
         //echo $staff_admin_id;
         mysqli_free_result($result);


        //  Getting client id using client name 
         $query = "SELECT client_id FROM clients WHERE
                client_name = '$client_name'LIMIT 1";
        echo $query;
         $result = mysqli_query($conn,$query);
         if ($result !== false){
            $row = mysqli_fetch_array($result);
            $client_id = $row[0];
         }
         //echo $client_id;
         mysqli_free_result($result);
        

        // Insert project info
        $query1 = "INSERT INTO projects(project_name , client_name , status , amount , amount_received , amount_pending , start_date , end_date , hosting_date , staff_admin_id , document_url) 
        VALUES('$project_name' , '$client_name' , '$status' , '$amount' , '$amount_paid', '$amount_pending' ,'$start_date' ,'$end_date' , '$hosting_date' , '$staff_admin_id','$fileName2' )";
        if(mysqli_query($conn, $query1)){
        	$project_id = mysqli_insert_id($conn);
        }
        $query = "INSERT INTO client_project_junc(client_id , project_id) VALUES('$client_id' , '$project_id')";
        if(mysqli_query($conn, $query)){
			header('Location:  http://localhost/Timesheet/backend-structure/show_project.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    }
    
    // Getting all the clients for dropdown
    $query = "SELECT * FROM clients";
    
    $result = mysqli_query($conn,$query);
    
    $clients = mysqli_fetch_all($result , MYSQLI_ASSOC);
    // var_dump($clients);
    
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
        
        <input type="text" name="project_name" placeholder = "Enter Project name...">
        <br>
        <select id="clients" name="client_name">
        <option>Choose client</option>
        <?php
        // dropdown 
        foreach($clients as $client){
            $client = $client['client_name'];
            echo "<option value = '$client'>$client</option>";
        }
        ?>
        </select>
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
        <input type="date" name="start_date" placeholder = "Enter Start Date...">
        <br>
        <input type="date" name="end_date" placeholder = "Enter End Date...">     
        <br> 
        <input type="date" name="hosting_date" placeholder = "Enter Hosting Date...">
        <br>
        <button type="submit" name = "submit">Submit</button>
        <br>
        <input type="file" name = "file1">
        <br>
        <button type="submit" name = "submit"><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/add_tasks.php'?>">Assign Tasks</button>
    </form>
</body>
</html>