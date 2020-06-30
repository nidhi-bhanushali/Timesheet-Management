<?php
    require('../../include/common/config.php');

    
    if($_GET){
        $staff_id = $_GET['id']; // print_r($_GET);       
    }else{
      echo "Url has no user";
    }


    $query = "SELECT * FROM tasks 
              JOIN task_staff_junc
              ON tasks.task_id = task_staff_junc.task_id
              WHERE staff_id = '$staff_id'";

    // Result
    $result = mysqli_query($conn,$query);

    // Fetch data
    $projects = mysqli_fetch_all($result , MYSQLI_ASSOC);
     var_dump($projects);

    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
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
    </style>
    <div>
        <h1>Clients</h1>
        <table>
        <tr>
            <th>client_id</th>
            <th>name</th>
            <th>contact</th>
            <th>address</th>
            <th>email</th>
            <th>project_name</th>
            <th>Edit</th>
            <th>Delete</th>
            <?php foreach($clients as $client):?>
                <tr>
                    <td><?php echo $client['client_id'] ;?></td>
                    <td><?php echo $client['client_name'] ;?></td>
                    <td><?php echo $client['contact'] ;?></td>
                    <td><?php echo $client['address'] ;?></td>
                    <td><?php echo $client['email'] ;?></td>
                    <td><?php echo $client['project_name'] ;?></td>
                    <td><button><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-2/' ?>update_client.php?id=<?php echo $client['client_id']; ?>">Edit</a></button></td>
                    <td><button><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-2/' ?>remove_client.php?id=<?php echo $client['client_id']; ?>">Delete</a></button></td>

                </tr>    
            <?php endforeach?>
            <br>
        </tr>
    </table>
    </div>
</body>
</html>

