<?php
    require('include/common/config.php');

    // getting all the projects
    $query = 'SELECT * FROM projects ORDER BY client_name';

    // Result
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
    <title>Projects</title>
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
        <h1>Projects</h1>
        <table>
        <tr>
            <th>project_id</th>
            <th>Project name</th>
            <th>client name</th>
            <th>status</th>
            <th>amount</th>
            <th>amount received</th>
            <th>amount pending</th>
            <th>start_date</th>
            <th>start_date</th>
            <th>start_date</th>
            <th>Edit</th>
            <?php foreach($projects as $project):?>
                <tr>
                    <td><?php echo $project['project_id'] ;?></td>
                    <td><?php echo $project['project_name'] ;?></td>
                    <td><?php echo $project['client_name'] ;?></td>
                    <td><?php echo $project['status'] ;?></td>
                    <td><?php echo $project['amount'] ;?></td>
                    <td><?php echo $project['amount_received'] ;?></td>
                    <td><?php echo $project['amount_pending'] ;?></td>
                    <td><?php echo $project['start_date'] ;?></td>
                    <td><?php echo $project['end_date'] ;?></td>
                    <td><?php echo $project['hosting_date'] ;?></td>
                    <td><button><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/' ?>update_project.php?id=<?php echo $project['project_id']; ?>">Edit</a></button></td>
                </tr>    
            <?php endforeach?>
            <br>
        </tr>
    </table>
    </div>

    <button><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/add_project.php'?>">Add New Project</button>
</body>
</html>
