<?php
require('../../include/common/config.php');

if(isset($_POST['submit'])){
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
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
    // $staff_id = implode(" , ",$id);
    // echo $staff_id;
    

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
                        header('Location:  http://localhost/Timesheet/backend-structure/show_project.php');
                    } else {
                        echo 'ERROR: '. mysqli_error($conn);
                    }
                }
            }
}
}

$query = 'SELECT * FROM staff where (role_id != 1)';
$result = mysqli_query( $conn , $query );
$staff = mysqli_fetch_all($result , MYSQLI_ASSOC);
mysqli_free_result($result);

$query = "SELECT * FROM progress";
    
$result = mysqli_query($conn,$query);

$progressArr = mysqli_fetch_all($result , MYSQLI_ASSOC);
var_dump($progressArr);

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
        var_dump($task);
    
        // Free Result
        mysqli_free_result($result);

        $query1 = 'SELECT * FROM tasks 
                  JOIN progress
                  ON tasks.progress_id = progress.progress_id      
                  WHERE task_id = '.$id;
    
        $result = mysqli_query($conn, $query1);
        
        // Fetch Data
        $task2 = mysqli_fetch_assoc($result);
        var_dump($task2);
    
        // Free Result
        mysqli_free_result($result);

        $query2 = 'SELECT * FROM staff 
        JOIN task_staff_junc
        ON staff.staff_id = task_staff_junc.staff_id 
        WHERE task_id = '.$id;

        $result = mysqli_query($conn, $query2);

        // Fetch Data
        $task1 = mysqli_fetch_assoc($result);
        var_dump($task1);

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

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
        <label>Project Name: </label>
        <input type="text" name="project_name" placeholder = "Enter name..."
        value = "<?php echo $task['project_name'];?>">
        <br>
        <label>Task Name: </label>
        <input type="text" name="task_name" placeholder = "Enter task..."
        value = "<?php echo $task['task_content'];?>">
        <br>
        <label>Deadline: </label>
        <input type="text" name="deadline" placeholder = "Enter deadline..."
        value = "<?php echo $task['Deadline'];?>">
        <br>
        <?php

        foreach($staff as $staffEl) {
          $staff_id = $staffEl['staff_id'];
        ?>
        <input type='checkbox' value = <?php echo $staff_id;?> name = '<?php echo "check_list[]";?>'
        <?php if($task1['staff_name']==$staffEl['staff_name']){echo "selected";}?>>
        <?php echo $staffEl['staff_name'];?>
        </input>
        <?php
        }
        ?>
      <!-- echo "<input type='checkbox' value='{$data['staff_name']}' name='check_list[]'>" . $data['staff_name'] ; -->
        
        <br>
        <br>
        <select id="roles" name="progress" >
        <option>Choose role</option>
        
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
        <br>
        <br>
        <button type="submit" name = "submit"><a href="<?php echo ROOT_URL; ?>"></a>Submit</button>
        <input type="hidden" name="update_id" value="<?php echo $task['task_id']; ?>">
    </form>
</body>
</html>