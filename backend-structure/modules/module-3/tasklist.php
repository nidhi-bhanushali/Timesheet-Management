<?php
   require('../../include/common/config.php');

   $query = 'SELECT * FROM tasks';

    // Result
    $result = mysqli_query($conn,$query);

    // Fetch data
    $tasks = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($tasks);

    mysqli_free_result($result);

    $query = 'SELECT * FROM notes
              JOIN tasks
              ON notes.task_id = tasks.task_id';

    // Result 
    $result = mysqli_query($conn,$query);

    // Fetch data
    $notes = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($notes);

    mysqli_free_result($result);

    $query = 'SELECT * FROM comments
              JOIN tasks
              ON comments.task_id = tasks.task_id';
    

    // Result
    $result = mysqli_query($conn,$query);

    // Fetch data
    $comments = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($comments);

    mysqli_free_result($result);


    $query1 = 'SELECT * FROM notes
                JOIN tasks
                ON notes.task_id = tasks.task_id';

    // Result
    $result = mysqli_query($conn,$query1);

    // Fetch data
    $task3 = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($task3);

    mysqli_free_result($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasklist</title>
</head>
<body>

<style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
    }
        th, td {
        padding: 5px;
    }
        th {
        text-align: left;
    }

        .note-item{
        border: 1px solid black;
        margin: 10px;
        width:400px;
        padding:20px;
        padding-top:10px;
        box-shadow: 3px 3px 3px 3px #888888;
        }
</style>

    <h3>TaskList</h3>
    <table>
        <tr>
            <th>Task id</th>
            <th>Task content</th>
            <th>Deadline</th>
            <th>Edit</th>
            <th>Delete</th>
            <?php foreach($tasks as $task):?>
                <tr>
                    <td><?php echo $task['task_id'] ;?></td>
                    <td><?php echo $task['task_content'] ;?></td>
                    <td><?php echo $task['Deadline'] ;?></td>
                    <td><button><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/' ?>update_task.php?id=<?php echo $task['task_id']; ?>">Edit</a></button></td>
                    <td><button><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/' ?>remove_task.php?id=<?php echo $task['task_id']; ?>">Delete</a></button></td>

                </tr>    
            <?php endforeach?>
            <br>
        </tr>
    </table>

    <br>
    <br>

</body>
</html>