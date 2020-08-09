<?php
require('../../include/common/config.php');
include('../../include/common/session.php');
    if(isset($_POST['submit'])){
        $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
		$client = mysqli_real_escape_string($conn, $_POST['client']);
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
                    client_name = '$client',
                    status ='$status',
                    amount='$amount',
                    amount_received = '$amount_paid',
                    amount_pending = '$amount_pending',
                    start_date = '$start_date',
                    end_date = '$end_date',
                    hosting_date = '$hosting_date'
            WHERE project_id = {$update_id}";

        if(mysqli_query($conn, $query)){
			header('Location:  http://localhost/Timesheet/backend-structure/modules/module-3/show_project.php');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    }

        // Getting all the clients for dropdown
        $query2 = "SELECT * FROM clients";
    
        $result = mysqli_query($conn,$query2);
        
        $clients = mysqli_fetch_all($result , MYSQLI_ASSOC);
        // var_dump($clients);
        
        mysqli_free_result($result);

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

<?php
include('../../include/css/header.php');
?>
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Update</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Update</li>
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
                <label for="inputName">Project Name</label>
                <input type="text" id="inputName" class="form-control" name="project_name"  value = "<?php echo $project['project_name'];?>">
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select class="form-control custom-select" name="status">
                  <option selected disabled>Select one</option>
                  <option value="<?php echo $project['status'];?>"<?php if($project['status']=='to do') echo 'selected="selected"'; ?>>To Do</option>
                  <option value="<?php echo $project['status'];?>"<?php if($project['status']=='ongoing') echo 'selected="selected"'; ?>>Ongoing</option>
                  <option value="<?php echo $project['status'];?>"<?php if($project['status']=='done') echo 'selected="selected"'; ?>>Done</option>
                </select>
              </div>
              <div class="form-group">
                <label>Client Name</label>
                <select class="form-control custom-select" name="client">
                  <option selected disabled>Select one</option>
                  <?php
                    foreach($clients as $client){
                    $client_id = $client['client_id'];
                    $client = $client['client_name'];
                  ?>
                    <option value="<?php echo $client;?>"
                    <?php if($project['client_name']==$client){echo "selected";}?>>
                    <?php echo $client;?> 
                    </option>
                    <?php
                    }
                    ?>
                </select>
              </div>
              <div class="form-group">
                <label for="totalAmount">Total Amount</label>
                <input type="number" id="totalAmount" class="form-control" name="amount" value = "<?php echo $project['amount'];?>">
              </div>
              <div class="form-group">
                <label for="paidAmount">Paid Amount</label>
                <input type="number" id="paidAmount" class="form-control" name="amount_paid" value = "<?php echo $project['amount_received'];?>">
              </div>
              <div class="form-group">
                <label for="pendingAmount">Pending Amount</label>
                <input type="number" id="pendingAmount" class="form-control" name="amount_pending" value = "<?php echo $project['amount_pending'];?>">
              </div>
              <div class="form-group">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" class="form-control" name="start_date" value = "<?php echo $project['start_date'];?>">
              </div>
              <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" class="form-control" name="end_date" value = "<?php echo $project['end_date'];?>">
              </div>
              <div class="form-group">
                <label for="hostingDate">Hosting Date</label>
                <input type="date" id="hostingDate" class="form-control" name="hosting_date" value = "<?php echo $project['hosting_date'];?>">
              </div>
              <div class="form-group">
                <input type="file" id="file" class="form-control" name="file1">
              </div>
              <input type="submit" value="Create new Project" class="btn btn-success float-right" name = "submit">
              <input type="hidden" name="update_id" value="<?php echo $project['project_id']; ?>">
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


<!-- <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
        <input type="text" name="project_name" placeholder = "Enter Project name...">
        <br>
        <input type="text" name="client_name" placeholder = "Enter Client name..."  >
        <br>
        <select name="status" id="">
        </select>
        <br>
        <input type="number" name="amount" placeholder = "Enter Amount..."  value = "<?php echo $project['amount'];?>">
        <br>        
        <input type="number" name="amount_paid" placeholder = "Enter Amount paid..."  value = "<?php echo $project['amount_received'];?>">
        <br>
        <input type="number" name="amount_pending" placeholder = "Enter Amount pending..."  value = "<?php echo $project['amount_pending'];?>">
        <br>
        <input type="date" name="start_date" placeholder = "Enter Start Date..."  value = "<?php echo $project['start_date'];?>">
        <br>
        <input type="date" name="end_date" placeholder = "Enter End Date..."  value = "<?php echo $project['end_date'];?>">     
        <br> 
        <input type="date" name="hosting_date" placeholder = "Enter Hosting Date..."  value = "<?php echo $project['hosting_date'];?>">
        <br>
        <button type="submit" name = "submit">Submit</button>
        <input type="hidden" name="update_id" value="<?php echo $project['project_id']; ?>">
        <br>
        <button type="submit" name = "submit">Assign Tasks</button>
    </form>
</body>
</html>
 -->



