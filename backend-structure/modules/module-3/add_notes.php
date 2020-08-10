<?php
    require('../../include/common/config.php');
    include('../../include/common/session.php');

    $staff_id = $_SESSION['staff_id'];

    if(isset($_POST['submit'])){
		
        $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
		    $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
        $note_content = mysqli_real_escape_string($conn,$_POST['note_content']);
        
        // Get staff id 
        $sql1 = "SELECT staff_id FROM staff WHERE
        staff_name = '$staff_name'LIMIT 1";
        echo $sql1;
        $result = mysqli_query($conn,$sql1);
        if ($result !== false){ 
            $row = mysqli_fetch_array($result);
            $staff_id = $row[0];
        }
        mysqli_free_result($result);


        // getting task id of the tasks for which the note is put
        $sql2 = "SELECT task_id FROM tasks WHERE
        task_content = '$task_name'LIMIT 1";
        echo $sql2;
        $result = mysqli_query($conn,$sql2);
        if ($result !== false){
            $row = mysqli_fetch_array($result);
            $task_id = $row[0];
        }
        mysqli_free_result($result);


        // Inserting notes in database
        $query = "INSERT INTO notes(notes_content , staff_id , task_id) VALUES('$note_content' , '$staff_id' , '$task_id')";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/modules/module-3/tasklist.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    } 
    

?>



<?php
include('../../include/css/header2.php');
?>
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 offset-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Comments</h3>
              </div>
                <form role="form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                  <label>Staff Name: </label>
                    <input class="form-control" type="text" name="staff_name" placeholder = "Enter staff name...">
                  </div>
                  <div class="form-group">
                  <label>Task Name: </label>
                    <input class="form-control" type="text" name="task_name" placeholder = "Enter task...">
                  </div>
                  <div class="form-group">
                  <label>Note Content: </label>
                  <textarea type="text" name="note_content" placeholder = "Enter note..." class="form-control"></textarea>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>
            </div>
            </div>
    </section>
    </div>

<?php
include('../../include/js/footer.php');
?>
