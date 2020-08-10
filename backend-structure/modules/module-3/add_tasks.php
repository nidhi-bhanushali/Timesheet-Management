<?php
require('../../include/common/config.php');
include('../../include/common/session.php');

if(isset($_POST['submit'])){
    $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);
    $project_name = mysqli_real_escape_string($conn, $_POST['project_name']);
    $task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
    $progress = mysqli_real_escape_string($conn,$_POST['progress']);
    // echo $progress;
    $deadline = mysqli_real_escape_string($conn,$_POST['deadline']);

    // file upload
    $fileName1 = rand(1000,10000)."-".$_FILES['file']['name'];
    $tname = $_FILES['file']['tmp_name'];
    $upload_dir = 'C:/xampp1/htdocs/Timesheet/backend-structure/uploads1';
    move_uploaded_file($tname , $upload_dir.'/'.$fileName1);

    // Multiple checkbox 
    if(!empty($_POST['check_list'])){
        $checkbox = $_POST['check_list'];
        print_r($checkbox);
        $checked=[];
        // Loop to store and display values of individual checked checkbox.
        foreach($checkbox as $selected){
            array_push($checked,$selected);
        }
        print_r($checked);
    }
    
    $id = [];
    $i = 0;
    // Getting staff id of each staff member whose checkbox is ticked
    foreach($checkbox as $checkbox){
        $query = "SELECT staff_id from staff WHERE 
                staff_name = '$checkbox'";
        //echo $query;
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result);
        //echo $row[$i];
        array_push($id , $row[$i]);
    }

    // getting project id using project name
    $query = "SELECT project_id FROM projects WHERE
                project_name = '$project_name'LIMIT 1";
    //echo $query;
    $result = mysqli_query($conn,$query);
    if ($result !== false){
    $row = mysqli_fetch_array($result);
    $project_id = $row[0];
    }
    //echo $project_id;
    mysqli_free_result($result);

    // getting progress id 
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


        // Inserting task info
        $sql = "INSERT INTO tasks(task_content , Deadline , project_id , progress_id,document_url)
                VALUES( '$task_name','$deadline' , '$project_id' , '$progress_id','$fileName1')";
        if(mysqli_query($conn ,$sql)){
                $task_id = mysqli_insert_id($conn);
            for($j = 0 ; $j < count($id) ; $j++){
                $query = "INSERT INTO staff_project_junc(staff_id , project_id) VALUES('" . $id[$j] . "' , '$project_id')";
                if(mysqli_query($conn, $query)){
                    $query1 = "INSERT INTO task_staff_junc(staff_id , task_id) VALUES('" . $id[$j] . "' , '$task_id' )";
                    if(mysqli_query($conn, $query1)){
                        header('Location:  http://localhost/Timesheet/backend-structure/modules/module-3/show_project.php');
                    } else {
                        echo 'ERROR: '. mysqli_error($conn);
                    }
                }
            }
}
}


        // Fetching progress for dropdown
        $query = "SELECT * FROM progress";
            
        $result = mysqli_query($conn,$query);

        $progress = mysqli_fetch_all($result , MYSQLI_ASSOC);
        //var_dump($progress);

        mysqli_free_result($result);

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
            <h1>Task Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Task Add</li>
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
                  echo "<option value = '$project'>$project</option>";
              }
              ?>
              </select>
              </div>
              <div class="form-group">
                <label>Task Content</label>
                <input type="text" class="form-control" name="task_name">
              </div>
              <div class="form-group">
              <label>Progress: </label>
              <select id="progress" name="progress" class = "form-control custom-select">
              <option>Choose progress</option>
              <?php
              foreach($progress as $progress){
                  $progress = $progress['progress'];
                  echo "<option value = '$progress'>$progress</option>";
              }
              ?>
              </select>
            </div>
              <div class = "form-group">
              <label>Deadline: </label>
              <input type="date" name="deadline" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"
              class = "form-control"/>
             </div>
             <div class="form-group">
              <select id="roles" name="role_name" onchange="showUser(this.value)" class = "form-control custom-select">
              <option>Choose role</option>
              <?php
              foreach($roles as $role){
                  $role_nameEl = $role['role_name'];
                  echo "<option value = '$role_nameEl'>$role_nameEl</option>";
                  
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
  <!-- /.content-wrapper -->

<?php
include('../../include/js/footer.php');
?> 