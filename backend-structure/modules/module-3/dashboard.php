<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .project-management{
            list-style-type : none;
            width: 200px;
            background-color:#dedede;
            height:100vh;
        }

        .project-management li{
            margin: 40px 0px;
        }

        .project-management li a{
            text-decoration: none;
        }
    </style>

    <div>
        <ul class = "project-management">
            <li style = "padding-top:20px ; margin-top:0px;">Logo</li>
            <li>Dashboard</li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/roles.php'?>">Add Roles<a></li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/show_project.php'?>">Project List</li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/show_client.php'?>">Client List</li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/add_tasks.php'?>">Add Tasks</li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/taskboard.php'?>">Taskboard</li>
            <li><a href = "<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/tasklist.php'?>">Tasklist</li>
        </ul>
    </div>
</body>
</html>