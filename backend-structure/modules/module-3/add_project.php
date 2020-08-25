
 <?php
    require('../../include/common/config.php');
    include('../../include/common/session.php');
    require('../../PHPMailerAutoload.php');
    require('../../credential.php');


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

        // Send mail
        $mail = new PHPMailer;

        $mail->SMTPDebug = 4;                               // Enable verbose debug output
        
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = EMAIL;                 // SMTP username
        $mail->Password = PASSWORD;                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        
        $mail->setFrom(EMAIL, 'Mailer');
        $mail->addAddress(RECIPIENT, 'Joe User');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo(EMAIL);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        //$mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = 'Here is the subject';
        //$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }


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
			header('Location:  http://localhost/Timesheet/backend-structure/modules/module-3/show_project.php');
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

<?php
include('../../include/css/header.php');
?>
      <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Add</li>
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
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form" enctype = "multipart/form-data">
              <div class="form-group">
                <label for="inputName">Project Name</label>
                <input type="text" id="inputName" class="form-control" name="project_name">
              </div>
              <div class="form-group">
                <label for="inputStatus">Status</label>
                <select class="form-control custom-select" name="status" id="">
                  <option selected disabled>Select one</option>
                  <option value="to do">To Do</option>
                  <option value="ongoing">Ongoing</option>
                  <option value="done">Done</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="inputStatus">Client Name</label>
                <select class="form-control custom-select" name="client_name">
                  <option selected disabled>Select one</option>
                  <?php
                  // dropdown 
                  foreach($clients as $client){
                      $client = $client['client_name'];
                      echo "<option value = '$client'>$client</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="totalAmount">Total Amount</label>
                <input type="number" id="totalAmount" class="form-control" name="amount">
              </div>
              <div class="form-group">
                <label for="paidAmount">Paid Amount</label>
                <input type="number" id="paidAmount" class="form-control" name="amount_paid">
              </div>
              <div class="form-group">
                <label for="pendingAmount">Pending Amount</label>
                <input type="number" id="pendingAmount" class="form-control" name="amount_pending">
              </div>
              <div class="form-group">
                <label for="startDate">Start Date</label>
                <input type="date" id="startDate" class="form-control" name="start_date">
              </div>
              <div class="form-group">
                <label for="endDate">End Date</label>
                <input type="date" id="endDate" class="form-control" name="end_date">
              </div>
              <div class="form-group">
                <label for="hostingDate">Hosting Date</label>
                <input type="date" id="hostingDate" class="form-control" name="hosting_date">
              </div>
              <div class="form-group">
                <input type="file" id="file" class="form-control" name="file1">
              </div>
              <input type="submit" value="Create new Project" class="btn btn-success float-right" name = "submit">
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

