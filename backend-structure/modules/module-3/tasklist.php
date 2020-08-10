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



<html>
<head>
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
        xmlhttp.open("GET", "getuser.php?q="+str, true);
        xmlhttp.send();
      }
    }
  </script>
</head>
<body>
  <form>
    <select name="users" onchange="showUser(this.value)">
    <option value="">Select a person:</option>
    <option value="1">Mark Dooley</option>
    <option value="2">Lewis Kirkbride</option>
    <option value="3">Jack Lee</option>
    <option value="4">Mary Jefferson</option>
    </select>
  </form>
  <br>
  <div id="txt_hint"><b>This is where info about the person is displayed.</b></div>
</body>
</html>



$ticked = [];
                  foreach($staff as $staffEl) {
                    array_push($ticked , $staffEl);
                  ?>
                  <input type='checkbox' value = <?php echo $staff_id;?> name = '<?php echo "check_list[]";?>'
                  <?php if(in_array($ticked , $task1['staff_name'])){echo "selected";}?>>
                  <?php echo $staffEl['staff_name'];?>
                  </input>
                  <?php
                  }