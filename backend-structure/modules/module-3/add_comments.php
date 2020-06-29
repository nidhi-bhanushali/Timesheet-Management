<?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		
		$task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
        $comment_content = mysqli_real_escape_string($conn,$_POST['comment_content']);

        $sql2 = "SELECT task_id FROM tasks WHERE
        task_content = '$task_name'LIMIT 1";
        echo $sql2;
        $result = mysqli_query($conn,$sql2);
        if ($result !== false){
            $row = mysqli_fetch_array($result);
            $task_id = $row[0];
        }
        mysqli_free_result($result);



        $query = "INSERT INTO comments(comment_content , task_id) VALUES('$comment_content' , '$task_id')";

        if(mysqli_query($conn, $query)){
            header('Location: http://localhost/Timesheet/backend-structure/modules/module-3/tasklist.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
    } 
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notes</title>
</head>
<body>
<h3>Comments</h3>
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
        <label>Task Name: </label>
        <input type="text" name="task_name" placeholder = "Enter task...">
        <br>
        <label>Comment Content: </label>
        <textarea type="text" name="comment_content" placeholder = "Enter comment..."></textarea>

        <br>
        <br>
        <button type="submit" name = "submit">Add Note</button>
    </form>


</body>
</html>
