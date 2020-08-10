<?php

session_start();
   
   $user_check = $_SESSION['user'];
   
   $ses_sql = mysqli_query($conn,"select email from staff where email = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['email'];
   
   if(!isset($_SESSION['user'])){
      header("location:http://localhost/Timesheet/backend-structure/modules/module-1/login.php");
      die();
   }

?>   