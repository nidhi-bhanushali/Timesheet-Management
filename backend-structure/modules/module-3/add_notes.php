<?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		
        $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
		$task_name = mysqli_real_escape_string($conn, $_POST['task_name']);
        $note_content = mysqli_real_escape_string($conn,$_POST['note_content']);
        
        $sql1 = "SELECT staff_id FROM staff WHERE
        staff_name = '$staff_name'LIMIT 1";
        echo $sql1;
        $result = mysqli_query($conn,$sql1);
        if ($result !== false){
            $row = mysqli_fetch_array($result);
            $staff_id = $row[0];
        }
        mysqli_free_result($result);

        $sql2 = "SELECT task_id FROM tasks WHERE
        task_content = '$task_name'LIMIT 1";
        echo $sql2;
        $result = mysqli_query($conn,$sql2);
        if ($result !== false){
            $row = mysqli_fetch_array($result);
            $task_id = $row[0];
        }
        mysqli_free_result($result);



        $query = "INSERT INTO notes(notes_content , staff_id , task_id) VALUES('$note_content' , '$staff_id' , '$task_id')";

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
<h3>Notes</h3>
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
        <label>Staff Name: </label>
        <input type="text" name="staff_name" placeholder = "Enter name...">
        <br>
        <label>Task Name: </label>
        <input type="text" name="task_name" placeholder = "Enter task...">
        <br>
        <label>Note Content: </label>
        <textarea type="text" name="note_content" placeholder = "Enter note..."></textarea>

        <br>
        <br>
        <button type="submit" name = "submit">Add Note</button>
    </form>


</body>
</html>
