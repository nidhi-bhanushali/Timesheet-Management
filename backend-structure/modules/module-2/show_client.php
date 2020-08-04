<?php
    require('../../include/common/config.php');

    // Query
    $query = 'SELECT * FROM clients ORDER BY client_name';

    // Result
    $result = mysqli_query($conn,$query);

    // Fetch data
    $clients = mysqli_fetch_all($result , MYSQLI_ASSOC);
     //var_dump($clients);

    mysqli_free_result($result);

    // Close connection
    mysqli_close($conn);

?>


<?php 
    include('../../include/css/header.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div class="card">
      <div class = "card-header">
        <h3 class = "card-title">Clients</h3>
      </div>
      <div class = "card-body">
        <table class="table table-striped">
        <tr>
            <th>Client_id</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Address</th>
            <th>Email</th>
            <th>Project_name</th>
            <th>Edit</th>
            <?php foreach($clients as $client):?>
                <tr>
                    <td><?php echo $client['client_id'] ;?></td>
                    <td><?php echo $client['client_name'] ;?></td>
                    <td><?php echo $client['contact'] ;?></td>
                    <td><?php echo $client['address'] ;?></td>
                    <td><?php echo $client['email'] ;?></td>
                    <td><?php echo $client['project_name'] ;?></td>
                    <td><button type="button" class="btn btn-block btn-outline-secondary"><a href="<?php echo 'http://localhost/Timesheet/backend-structure/modules/module-2/' ?>update_client.php?id=<?php echo $client['client_id']; ?>">Edit</a></button></td>
                </tr>    
            <?php endforeach?>
            <br>
        </tr>
    </table>
    </div>
    </div>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
<?php
include('../../include/js/footer.php');
?>
