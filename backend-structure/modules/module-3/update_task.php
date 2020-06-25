<?php
    require('../../include/common/config.php');

    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn,$_POST['contact']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
        
        $query = "UPDATE clients SET 
                    client_name='$name',
                    contact='$contact',
                    email='$email',
                    address = '$address',
                    project_name = '$project_name' 
            WHERE client_id = {$update_id}";

        if(mysqli_query($conn, $query)){
			header('Location:  http://localhost/Timesheet/backend-structure/show_client.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    }

    if(isset($_GET['id'])){
        try{
          $id = mysqli_real_escape_string($conn, $_GET['id']);
      
          $query = 'SELECT * FROM clients WHERE client_id = '.$id;
      
          $result = mysqli_query($conn, $query);
          
          // Fetch Data
          $client = mysqli_fetch_assoc($result);
          var_dump($client);
      
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

