
 <?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $role_name = mysqli_real_escape_string($conn,$_POST['role_name']);
        $social_media = mysqli_real_escape_string($conn,$_POST['social_media']);
        echo $role_name;
        echo $social_media;

        // echo $role_id;

        $query = "INSERT INTO roles(role_name , social_media) VALUES('$role_name' , '$social_media')";

        if(mysqli_query($conn, $query)){
            header('Location: roles.php');
        } else {
            echo 'ERROR: '. mysqli_error($conn);
        }
       
    } 

?>

<?php
include('../../include/css/header.php');
?>
    <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 offset-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Roles</h3>
              </div>
                <form role="form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <div class="card-body">
                  <div class="form-group">
                  <label>Role Name: </label>
                    <input class="form-control" type="text" name="role_name" placeholder = "Enter role name...">
                  </div>
                  <div class="form-group">
                  <input type="checkbox" name="social_media" class = "checkbox" value="1">
                  <label>Social Media Manager </label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>
            </div>
            </div>
    </section>
    </div>

<?php
include('../../include/js/footer.php');
?>