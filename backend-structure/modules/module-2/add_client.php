
 <?php
   require('../../include/common/config.php');
   include('../../include/common/session.php');


    if(isset($_POST['submit'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn,$_POST['contact']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $project_name = mysqli_real_escape_string($conn,$_POST['project_name']);
        //echo $address;
        // echo $role_id;
        
        // inserting client info
        $query = "INSERT INTO clients(client_name , email , contact , address , project_name) VALUES('$name' , '$email' , '$contact' , '$address' , '$project_name')";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/modules/module-2/show_client.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    } 
    

?>

<?php
include('../../include/css/header.php');
?>
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Client Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
              <div class="form-group">
                <label>Client Name</label>
                <input type="text" id="clientName" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label for="inputName">Project Name</label>
                <input type="text" id="inputName" class="form-control" name="project_name">
              </div>
              <div class="form-group">
                <label>Email: </label>
                <input type="email" id="email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <label>Contact</label>
                <input type="number" id= "contact" class="form-control" name="contact">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="form-control" name="address">
              </div>
              <input type="submit" value="Create new Client" class="btn btn-success float-right" name = "submit">
            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include('../../include/js/footer.php');
?>


