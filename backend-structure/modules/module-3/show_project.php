<?php
   require('../../include/common/config.php');
   include('../../include/common/session.php');

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

<?php 
    include('../../include/css/header.php');
?>
    <div class="content-wrapper">
    <div class="card">
      <div class = "card-header">
      <h1 class= "card-title">Projects</h1>
      <a href = "http://localhost/Timesheet/backend-structure/modules/module-3/add_project.php"><input type="submit" value="Create new Project" class="btn btn-success float-right" name = "submit"></a>
      </div>
      <div class = "card-body">
        <table class = "table table-striped">
        <tr>
            <th>Project_id</th>
            <th>Project name</th>
            <th>Client name</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Amount received</th>
            <th>Amount pending</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Hosting date</th>
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
                    <td><button type="button" class="btn btn-block btn-outline-secondary"><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-3/' ?>update_project.php?id=<?php echo $project['project_id']; ?>">Edit</a></button></td>
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
