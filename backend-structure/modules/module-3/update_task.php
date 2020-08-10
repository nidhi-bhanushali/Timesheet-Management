<?php
require('../../include/common/config.php');
include('../../include/common/session.php');

if(isset($_POST['submit'])){
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
    $progress = mysqli_real_escape_string($conn,$_POST['progress']);
    echo $progress;
    $deadline = mysqli_real_escape_string($conn,$_POST['deadline']);
    if(!empty($_POST['check_list'])){
        $checkbox = $_POST['check_list'];
        $checked=[];
        // Loop to store and display values of individual checked checkbox.
        foreach($checkbox as $selected){
            array_push($checked,$selected);
        }
        print_r($checked); 
    }
    
    $id = [];
    $i = 0;
    foreach($checkbox as $checkbox){
        $query = "SELECT staff_id from staff WHERE 
                staff_name = '$checkbox'";
        echo $query;
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        echo $row[$i];
        array_push($id , $row[$i]);
    }
    print_r($id);
    mysqli_free_result($result);
    

    $query = "SELECT project_id  FROM projects WHERE
                project_name = '$project_name'LIMIT 1";
    //echo $query;
    $result = mysqli_query($conn,$query);
    if ($result !== false){
    $row = mysqli_fetch_array($result);
    $project_id = $row[0];
    }
    //echo $project_id;
    mysqli_free_result($result);

    $query = "SELECT progress_id FROM progress WHERE
    progress = '$progress'LIMIT 1";
    //echo $query;
    $result = mysqli_query($conn,$query);
    if ($result !== false){
    $row = mysqli_fetch_array($result);
    $progress_id = $row[0];
    }
    //echo $progress_id;
    mysqli_free_result($result);

        $sql = "UPDATE tasks SET
                project_name = '$project_name',
                task_name = '$task_name',
                progress = '$progress',
                Deadline = '$deadline'
                WHERE task_id = {$update_id}";
        if(mysqli_query($conn ,$sql)){
                $task_id = mysqli_insert_id($conn);
            for($j = 0 ; $j < count($id) ; $j++){
                $query = "UPDATE staff_project_junc SET
                        staff_id = {$id[$j]},
                        project_id = {$project_id}
                        WHERE task_id = {$update_id}";
                
                // (staff_id , project_id) VALUES('" . $id[$j] . "' , '$project_id')
                if(mysqli_query($conn, $query)){
                    $query1 = "UPDATE task_staff_junc SET
                    staff_id = {$id[$j]},
                    task_id = {$task_id}
                    WHERE task_id = {$update_id}";
                    if(mysqli_query($conn, $query1)){
                        header('Location:  http://localhost/Timesheet/backend-structure/modules/module-3/show_project.php');
                    } else {
                        echo 'ERROR: '. mysqli_error($conn);
                    }
                }
            }
}
}


    // Fetching project names for dropdown
    $query = "SELECT * FROM projects";
    
    $result = mysqli_query($conn,$query);

    $projects = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($projects);

    // Fetching roles for dropdown
    $query = "SELECT * FROM roles";
        
    $result = mysqli_query($conn,$query);

    $roles = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($roles);

    mysqli_free_result($result);

$query = "SELECT * FROM progress";
    
$result = mysqli_query($conn,$query);

$progressArr = mysqli_fetch_all($result , MYSQLI_ASSOC);
//var_dump($progressArr);

mysqli_free_result($result);

    if(isset($_GET['id'])){
      try{
        $id = mysqli_real_escape_string($conn, $_GET['id']);
    
        $query = 'SELECT * FROM tasks 
                  JOIN projects
                  ON tasks.project_id = projects.project_id       
                  WHERE task_id = '.$id;
    
        $result = mysqli_query($conn, $query);
        
        // Fetch Data 
        $task = mysqli_fetch_assoc($result);
        //var_dump($task);
    
        // Free Result
        mysqli_free_result($result);

        $query1 = 'SELECT * FROM tasks 
                  JOIN progress
                  ON tasks.progress_id = progress.progress_id      
                  WHERE task_id = '.$id;
    
        $result = mysqli_query($conn, $query1);
        
        // Fetch Data
        $task2 = mysqli_fetch_assoc($result);
        //var_dump($task2);
    
        // Free Result
        mysqli_free_result($result);

        $query2 = 'SELECT * FROM staff 
        JOIN task_staff_junc
        ON staff.staff_id = task_staff_junc.staff_id 
        WHERE task_id = '.$id;

        $result = mysqli_query($conn, $query2);

        // Fetch Data
        $task1 = mysqli_fetch_assoc($result);
        //var_dump($task1);

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
      <!-- Content Wrapper. Contains page content -->
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
        <div class="col-md-6 offset-3">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Tasks</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
            <form method="post" enctype = "multipart/form-data">
              <div class="form-group">
              <label>Project Name: </label>
              <select id="projects" name="project_name" class = "form-control custom-select">
              <option>Choose project</option>
              <?php
              foreach($projects as $project){
                  $project = $project['project_name'];
              ?>
                  <option value="<?php echo $project;?>"
                  <?php if($task['project_name']==$project){echo "selected";}?>>
                  <?php echo $project;?> 
                  </option>
                  <?php
                  }
                  ?>
              </select>
              </div>
              <div class="form-group">           
                <label>Task Content</label>
                <input type="text" class="form-control" name="task_name" value = "<?php echo $task['task_content'];?>">
              </div>
              <div class="form-group">
              <label>Progress: </label>
              <select id="progress" name="progress" class = "form-control custom-select">
              <option>Choose progress</option>
              <?php
                foreach($progressArr as $progressArr1){
                $progress_id = $progressArr1['progress_id'];
                $progress = $progressArr1['progress'];
                ?>
                <option value="<?php echo $progress_id;?>"
                <?php if($task2['progress_id']==$progress_id){echo "selected";}?>>
                <?php echo $progress;?> 
                </option>
                <?php
                }
              ?>
              </select>
            </div>
              <div class = "form-group">
              <label>Deadline: </label>
              <input type="date" name="deadline" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"
              class = "form-control" value = "<?php echo $task['Deadline'];?>"/>
             </div>
             <div class="form-group">
              <select id="roles" name="role_name" class = "form-control custom-select">
              <option>Choose role</option>
              <?php
              foreach($roles as $role_nameEl){
                  $role_nameEl = $role_nameEl['role_name'];
                ?>
                <option value="<?php echo $role_name;?>"
                <?php if($role_name==$role_nameEl){echo "selected";}?>>
                <?php echo $role_name;?> 
                </option>
                <?php
                }
                    ?>
              </select>
              </div>
              <div id="txt_hint"></div>
             <div>
             <div class="form-group">
               <label>Choose File</label>
                <input type="file" class="form-control" name="file">
              </div>
             <input type="submit" value="Create new Task" class="btn btn-success float-right" name = "submit">
             <input type="hidden" name="update_id" value="<?php echo $task['task_id']; ?>">
            </div>
            </form> 
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    function showUser(str) {
      if (str == '') {
        document.getElementById("txt_hint").innerHTML = "";
        return;
      } else { 
        if (window.XMLHttpRequest) {
          // script for browser version above IE 7 and the other popular browsers (newer browsers)
          xmlhttp = new XMLHttpRequest();
        } else {
          // script for the IE 5 and 6 browsers (older versions)
          xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            // get the element in which we will use as a placeholder and space for table
            document.getElementById("txt_hint").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "checkbox.php?q="+str, true);
        xmlhttp.send();
     }
    }
  </script>
<?php
include('../../include/js/footer.php');
?> 
