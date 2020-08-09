<?php
    require('../../include/common/config.php');
    include('../../include/common/session.php');

    if (isset($_SESSION['user'])) {
    
    if($_GET){
        $staff_id = $_GET['id']; // print_r($_GET);        
    }else{
      echo "Url has no user";
    }

    // Getting tasks alloted to individual staff member according to his id
    $query = "SELECT * FROM task_staff_junc
              JOIN tasks
              ON task_staff_junc.task_id = tasks.task_id
              JOIN progress
              ON tasks.progress_id = progress.progress_id
              WHERE staff_id = '$staff_id'";  

    // Result
    $result = mysqli_query($conn,$query);

    // Fetch data
    $tasks = mysqli_fetch_all($result , MYSQLI_ASSOC);
     //var_dump($tasks);

    mysqli_free_result($result);
    // Close connection
    mysqli_close($conn);


?>

<?php 
    include('../../include/css/header2.php');
?>
    <div class="content-wrapper">
    <div class="card">
      <div class = "card-header">
      <h1 class= "card-title">Projects</h1>
      </div>
      <div class = "card-body">
        <table class = "table table-striped">
        <tr>
            <th>Task Content</th>
            <th>Deadline</th>
            <th>Progress</th>
            <?php foreach($tasks as $task):?>
                <tr>
                    <td><?php echo $task['task_content'] ;?></td>
                    <td><?php echo $task['Deadline'] ;?></td>
                    <td><?php echo $task['progress'] ;?></td>
                </tr>    
            <?php endforeach?>
            <br>
        </tr>
    </table>
    </div>
    </div>
    </div>

<?php
include('../../include/js/footer.php');
?>
<?php
    }
 ?>   
