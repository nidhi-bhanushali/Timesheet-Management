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
        <input type="text" name="name" placeholder = "Enter name..."
         value = "<?php echo $client['client_name'];?>">
        <br>
        <label>Email: </label><br>
        <input type="email" name="email" placeholder = "Enter email..."
        value = "<?php echo $client['email'];?>">
        <br>
        <label>Contact: </label><br>
        <input type="number" name="contact" placeholder = "Enter contact..."
        value = "<?php echo $client['contact'];?>">
        <br>
        <label>Address: </label>
        <input type="text" name="address" placeholder = "Enter address..."
        value = "<?php echo $client['address'];?>">
        <br>
        <label>Project Name: </label>
        <input type="text" name="project_name" placeholder = "Enter project_name..."
        value = "<?php echo $client['project_name'];?>">
        <br>
        <br>
        <button type="submit" name = "submit" value="Submit">Submit</button>
        <input type="hidden" name="update_id" value="<?php echo $client['client_id']; ?>">
    </form>
</body>
</html>
