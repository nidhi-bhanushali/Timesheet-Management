<?php
require('../../include/common/config.php');
include('../../include/common/session.php');

//session_start();

if (isset($_SESSION['user']))
{
// Query
$query = 'SELECT count(*) FROM projects';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$projects = mysqli_fetch_all($result);
//var_dump($projects);

mysqli_free_result($result);

$query = 'SELECT count(*) FROM projects
          WHERE projects.status = "ongoing"';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$ongoing = mysqli_fetch_all($result);
//var_dump($ongoing);

mysqli_free_result($result);

$query = 'SELECT count(*) FROM projects
          WHERE projects.status = "done"';

// Result
$result = mysqli_query($conn,$query);

// Fetch data
$done = mysqli_fetch_all($result);
//var_dump($done);

mysqli_free_result($result);

// Clients section
$query = 'SELECT * FROM clients ORDER BY client_name LIMIT 5';

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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Total Projects</h3>
                <?php foreach($projects as $project):?>
                    <h4><?php echo $project[0]?></h4>
                <?php endforeach?> 
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <h3>Total Ongoing</h3>
                <?php foreach($ongoing as $ongoing):?>
                    <h4><?php echo $ongoing[0]?></h4>
                <?php endforeach?> 
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <h3>Total Done</h3>
                <?php foreach($done as $done):?>
                    <h4><?php echo $done[0]?></h4>
                <?php endforeach?> 
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>

        <div class="card">
      <div class = "card-header">
        <h3>Clients</h3>
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
    </div>
    </section>





<?php
include('../../include/js/footer.php');
?> 

<?php
    }
 ?>   

    