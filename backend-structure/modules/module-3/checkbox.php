<?php 
require('../../include/common/config.php');
include('../../include/common/session.php');

$q = ($_GET['q']);
//print_r($q);

$sql = "SELECT role_id FROM roles WHERE role_name = '".$q."'";
$result = mysqli_query($conn,$sql);

if ($result !== false){
        $row = mysqli_fetch_array($result);
        $role_id = $row[0];
        }
        // echo $role_id;
        mysqli_free_result($result);
        
        if (!empty($role_id)) {
        $query1 = "SELECT * FROM staff where role_id = '$role_id'";
        $result = mysqli_query( $conn , $query1 );
        $data = mysqli_fetch_all($result , MYSQLI_ASSOC); 
        mysqli_free_result($result);
        ?>
        <div class = "form-check">
        <?php
        foreach($data as $data) {
        echo "<input type='checkbox' value='{$data['staff_name']}' class = 'form-check-input' name='check_list[]'>" . $data['staff_name'];
        echo "<br/>";
        }
    }
?>