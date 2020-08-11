
 <?php
    require('../../include/common/config.php');
    include('../../include/common/session.php');


    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
		    $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn,$_POST['contact']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        //echo $address;
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $role_name = mysqli_real_escape_string($conn,$_POST['role_name']);
        //echo $role_name;

        // File upload
        $fileName = rand(1000,10000)."-".$_FILES['file']['name'];
        $tname = $_FILES['file']['tmp_name'];
        $upload_dir = 'C:/xampp1/htdocs/Timesheet/backend-structure/uploads'; 
        move_uploaded_file($tname , $upload_dir.'/'.$fileName);

        // Getting the role_id from role_name
        $query = "SELECT role_id FROM roles WHERE
                role_name = '$role_name'LIMIT 1";
        echo $query;
         $result = mysqli_query($conn,$query);
         if ($result !== false){
            $row = mysqli_fetch_array($result);
            $role_id = $row[0];
         }
         mysqli_free_result($result);

        // echo $role_id;
        

        //  query for inserting staff info 
        $query = "INSERT INTO staff(staff_name,email,contact,address,password,role_id,document_url) 
                  VALUES('$name', '$email', '$contact','$address','$password',$role_id,'$fileName')";

        if(mysqli_query($conn, $query)){
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    } 

    // Fetching all the roles for dropdown
    $query = "SELECT * FROM roles";
    
    $result = mysqli_query($conn,$query);

    $roles = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($roles);

    mysqli_free_result($result);

    

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../include/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../include/AdminLTE-3.0.5/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../include/AdminLTE-3.0.5/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../include/AdminLTE-3.0.5/index2.html"><b>Dot</b>Minds</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form method="post" class="form" enctype = "multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name = "name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Contact" name = "contact">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Address" name = "address">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-home"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <select id="roles" name="role_name" class="form-control">
            <option>Choose role</option>
            <?php
            foreach($roles as $role_name){
                $role_name = $role_name['role_name'];
                echo "<option value = '$role_name'>$role_name</option>";
            }
            ?>
        </select>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name = "email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name = "password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
        <input type="file" name = "file" class="form-control">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
          <button type="submit" name = "submit" class = "btn btn-block btn-primary"><a href="<?php echo ROOT_URL; ?>"></a>Submit</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../include/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../include/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../include/AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
</body>
</html>
