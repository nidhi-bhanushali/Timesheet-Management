<?php
require('../../include/common/config.php');

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
        $checked=[];
        // Loop to store and display values of individual checked checkbox.
        foreach($checkbox as $selected){
            array_push($checked,$selected);
        }
        // print_r($checked);
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
                VALUES( '$task_name','$deadline' , '$project_id' , '$progress_id','$fileName')";
        if(mysqli_query($conn ,$sql)){
                $task_id = mysqli_insert_id($conn);
            for($j = 0 ; $j < count($id) ; $j++){
                $query = "INSERT INTO staff_project_junc(staff_id , project_id) VALUES('" . $id[$j] . "' , '$project_id')";
                if(mysqli_query($conn, $query)){
                    $query1 = "INSERT INTO task_staff_junc(staff_id , task_id) VALUES('" . $id[$j] . "' , '$task_id' )";
                    if(mysqli_query($conn, $query1)){
                        header('Location:  http://localhost/Timesheet/backend-structure/show_project.php');
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Tasks</title>
</head>
<body>
    <h3>Assign Tasks</h3>
    <style>
        .form{
            border: 1px solid black;
            padding: 10px;
            width: 200px;
            display: flex;
            flex-direction:column;
            justify-content : center;
            margin:200px auto ;
        }
    </style>

    <form method="post">
    <select id="roles" name="role_name">
        <option>Choose role</option>
        <?php
        foreach($roles as $role_name){
            $role_name = $role_name['role_name'];
            echo "<option value = '$role_name'>$role_name</option>";
        }
        ?>
        </select>
        <button id="Filter" name = "go">Go</button>
    </form>

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
    <select id="projects" name="project_name">
        <option>Choose project</option>
        <?php
        foreach($projects as $project){
            $project = $project['project_name'];
            echo "<option value = '$project'>$project</option>";
        }
        ?>
    </select>
        <br>
        <label>Task Name: </label>
        <input type="text" name="task_name" placeholder = "Enter task...">
        <br>
    <select id="progress" name="progress">
        <option>Choose progress</option>
        <?php
        foreach($progress as $progress){
            $progress = $progress['progress'];
            echo "<option value = '$progress'>$progress</option>";
        }
        ?>
    </select>
        <br>

        <label>Deadline: </label>
        <input type="date" name="deadline" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" title="Enter a date in this formart YYYY-MM-DD"/>
        <br>

    
        <?php
        if(isset($_POST['go'])){
            $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);
            if (!empty($role_name)) {
             $query1 = "SELECT role_id FROM roles WHERE
             role_name = '$role_name'LIMIT 1";
            // echo $query1;
             $result = mysqli_query($conn,$query1);
             if ($result !== false){
             $row = mysqli_fetch_array($result);
             $role_id = $row[0];
             }
            // echo $role_id;
             mysqli_free_result($result);
             
            if (!empty($role_id)) {
            $query1 = "SELECT * FROM staff where role_id = '$role_id'";
            $result = mysqli_query( $conn , $query1 );
            $data = mysqli_fetch_all($result , MYSQLI_ASSOC);
            mysqli_free_result($result);
            foreach($data as $data) {
            echo "<input type='checkbox' value='{$data['staff_name']}' name='check_list[]'>" . $data['staff_name'];
            }
        }
    
        }
    }
        ?>
        <br>
        <input type="file" name = "file">
        <br>
        <br>
        <button type="submit" name = "submit"><a href="<?php echo ROOT_URL; ?>"></a>Submit</button>
    </form>
</body>
</html>