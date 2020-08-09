<?php
   require('../../include/common/config.php');
   include('../../include/common/session.php');

    if(isset($_POST['submit'])){
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
			header('Location:  http://localhost/Timesheet/backend-structure/modules/module-2/show_client.php');
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
          //var_dump($client);
      
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
                <input type="text" id="clientName" class="form-control" name="name" value = "<?php echo $client['client_name'];?>">
              </div>
              <div class="form-group">
                <label for="inputName">Project Name</label>
                <input type="text" id="inputName" class="form-control" name="project_name" value = "<?php echo $client['project_name'];?>">
              </div>
              <div class="form-group">
                <label>Email: </label>
                <input type="email" id="email" class="form-control" name="email" value = "<?php echo $client['email'];?>">
              </div>
              <div class="form-group">
                <label>Contact</label>
                <input type="number" id= "contact" class="form-control" name="contact" value = "<?php echo $client['contact'];?>">
              </div>
              <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="form-control" name="address" value = "<?php echo $client['address'];?>">
              </div>
              <input type="submit" value="Create new Client" class="btn btn-success float-right" name = "submit">
              <input type="hidden" name="update_id" value="<?php echo $client['client_id']; ?>">
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



<!-- 
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
</html> -->
