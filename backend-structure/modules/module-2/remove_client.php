<?php
	require('../../include/common/config.php');

    if(isset($_GET['id'])){
        try{
          $id = mysqli_real_escape_string($conn, $_GET['id']);
      
          $query = 'DELETE FROM clients WHERE client_id = ' .$id;
      
          $result = mysqli_query($conn, $query);
          
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
    <title>Document</title>
</head>
<body>
    <h3>Client Removed</h3>
    <a href="http://localhost/Timesheet/backend-structure/show_client.php">Go to Clients</a>
</body>
</html>