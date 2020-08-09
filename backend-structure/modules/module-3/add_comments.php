<?php
   require('../../include/common/config.php');
   include('../../include/common/session.php');


    if(isset($_POST['submit'])){
		
		$task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
        $comment_content = mysqli_real_escape_string($conn,$_POST['comment_content']);

        // getting task id 
        $sql2 = "SELECT task_id FROM tasks WHERE
        task_content = '$task_name'LIMIT 1";
        echo $sql2;
        $result = mysqli_query($conn,$sql2);
        if ($result !== false){
            $row = mysqli_fetch_array($result);
            $task_id = $row[0];
        }
        mysqli_free_result($result);


        // Insert comments 
        $query = "INSERT INTO comments(comment_content , task_id) VALUES('$comment_content' , '$task_id')";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/modules/module-3/tasklist.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    } 
    

?>


<?php
include('../../include/css/header.php');
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
                  <label>Task Name: </label>
                    <input class="form-control" type="text" name="task_name" placeholder = "Enter task...">
                  </div>
                  <div class="form-group">
                  <label>Comment Content: </label>
                  <textarea type="text" name="comment_content" placeholder = "Enter comment..." class="form-control"></textarea>
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
