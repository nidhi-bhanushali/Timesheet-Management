<?php
   require('../../include/common/config.php');

// Query
$query = 'SELECT * FROM tasks
            JOIN task_staff_junc
            ON tasks.task_id = task_staff_junc.task_id
            JOIN staff
            ON task_staff_junc.staff_id = staff.staff_id
             WHERE tasks.progress_id = 2';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$ongoing = mysqli_fetch_all($result , MYSQLI_ASSOC);
//var_dump($ongoing);

mysqli_free_result($result);

$query = 'SELECT * FROM tasks
            JOIN task_staff_junc
            ON tasks.task_id = task_staff_junc.task_id
            JOIN staff
            ON task_staff_junc.staff_id = staff.staff_id
             WHERE tasks.progress_id = 1';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$todo = mysqli_fetch_all($result , MYSQLI_ASSOC);
//var_dump($todo);

mysqli_free_result($result);

$query = 'SELECT * FROM tasks
            JOIN task_staff_junc
            ON tasks.task_id = task_staff_junc.task_id
            JOIN staff
            ON task_staff_junc.staff_id = staff.staff_id
             WHERE tasks.progress_id = 3';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$done = mysqli_fetch_all($result , MYSQLI_ASSOC);
//var_dump($done);

mysqli_free_result($result);



// Fetching all notes
$query = 'SELECT * FROM notes
              JOIN tasks
              ON notes.task_id = tasks.task_id';

    // Result 
    $result = mysqli_query($conn,$query);

    // Fetch data
    $notes = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($notes);

    mysqli_free_result($result);



// Fetching all comments
$query = 'SELECT * FROM comments
          JOIN tasks
          ON comments.task_id = tasks.task_id';
        
    $result = mysqli_query($conn,$query);

    // Fetch data
    $comments = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($comments);

    mysqli_free_result($result);


// // Fetching projects
$query = 'SELECT project_name , task_id FROM projects
          JOIN tasks
          ON projects.project_id = tasks.project_id';
        
    $result = mysqli_query($conn,$query);

    // Fetch data
    $projects = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($projects);

    mysqli_free_result($result);


// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskBoard</title>
</head>
<body>

    <style>
    .tasks{
        border: 1px solid black;
        margin: 10px;
        width:200px;
        padding:20px;
        padding-top:10px;
        box-shadow: 3px 3px 3px 3px #888888;
        height:100%;
    }

    .task-item{
        border-bottom: 1px solid black;
    }

    </style>

    <div style = "display : flex;">
    <div class = "tasks">
    <h3>To Do</h3>
    <?php foreach ($todo as $task_todo) :?>
        <div class = "task-item">
    <?php 
        foreach($projects as $project){
        if($project['task_id'] == $task_todo['task_id']){
        ?>
        <h4>Project Name: <?php echo $project['project_name'];?></h4>
        <?php
        }
    } 
    ?>
            <h3><?php echo $task_todo['task_content'] ;?></h3>
            <h4>Assigned to <?php echo $task_todo['staff_name'];?></h4>
            <small>Due on <?php echo $task_todo['Deadline'];?></small>
    <?php 
        foreach($notes as $note){
        if($note['staff_id'] == $task_todo['staff_id'] && $note['task_id'] == $task_todo['task_id']){
        ?>
        <h4>Note : <?php echo $note['notes_content'];?></h4>
        <?php
        }
    } 
    ?>

    <?php
        foreach($comments as $comment){
        if($comment['task_id'] == $task_todo['task_id'] ){
        ?>
        <h4>Comments : <?php echo $comment['comment_content'];?></h4>
        <?php
        }
    } 
    ?>
        </div>
        <?php endforeach;?>
        
    </div>

    <div class = "tasks">
    <h3>Ongoing</h3>
    <?php foreach ($ongoing as $task_ongoing) :?>
    <div class = "task-item">
    <?php 
        foreach($projects as $project){
        if($project['task_id'] == $task_ongoing['task_id']){
        ?>
        <h4>Project Name: <?php echo $project['project_name'];?></h4>
        <?php
        }
    } 
    ?>
        <h3><?php echo $task_ongoing['task_content'] ;?></h3>
        <h4>Assigned to <?php echo $task_ongoing['staff_name'];?></h4>
        <small>Due on <?php echo $task_ongoing['Deadline'];?></small>
    <?php 
        foreach($notes as $note){
        if($note['staff_id'] == $task_ongoing['staff_id']  && $note['task_id'] == $task_ongoing['task_id']){
        ?>
        <h4>Note : <?php echo $note['notes_content'];?></h4>
        <?php
        }
    } 
    ?>

    <?php
        foreach($comments as $comment){
        if($comment['task_id'] == $task_ongoing['task_id'] ){
        ?>
        <h4>Comments : <?php echo $comment['comment_content'];?></h4>
        <?php
        }
    } 
    ?>

    </div>
    <?php endforeach;?>
    </div>

    <div class = "tasks">
    <h3>Done</h3>
    <?php foreach ($done as $task_done) :?>
    <div class = "task-item">
    <?php 
        foreach($projects as $project){
        if($project['task_id'] == $task_done['task_id']){
        ?>
        <h4>Project Name: <?php echo $project['project_name'];?></h4>
        <?php
        }
    } 
    ?>
        <h3><?php echo $task_done['task_content'] ;?></h3>
        <h4>Assigned to <?php echo $task_done['staff_name'];?></h4>
        <small>Due on <?php echo $task_done['Deadline'];?></small>
    <?php 
        foreach($notes as $note){
        if($note['staff_id'] == $task_done['staff_id']  && $note['task_id'] == $task_done['task_id']){
        ?>
        <h4>Note : <?php echo $note['notes_content'];?></h4>
        <?php
        }
    } 
    ?>

    <?php
        foreach($comments as $comment){
        if($comment['task_id'] == $task_done['task_id'] ){
        ?>
        <h4>Comments : <?php echo $comment['comment_content'];?></h4>
        <?php
        }
    } 
    ?>
    </div>
    <?php endforeach;?>
    </div>
    </div>
</body>
</html>
