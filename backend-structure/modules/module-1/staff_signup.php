
 <?php
    require('../../include/common/config.php');


    if(isset($_POST['submit'])){
		// print_r($_POST);
        // $name = htmlentities($_POST['name']);
        // echo $name;
        $name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
        $contact = mysqli_real_escape_string($conn,$_POST['contact']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        echo $address;
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        $role_name = mysqli_real_escape_string($conn,$_POST['role_name']);
        echo $role_name;


        $query = "SELECT role_id FROM roles WHERE
                role_name = '$role_name'LIMIT 1";
        echo $query;
         $result = mysqli_query($conn,$query);
         if ($result !== false){
            $row = mysqli_fetch_array($result);
            $role_id = $row[0];
         }
         mysqli_free_result($result);

        // echo $role_id;
        

        $query = "INSERT INTO staff(staff_name,email,contact,address,password,role_id) 
                  VALUES('$name', '$email', '$contact','$address','$password',$role_id)";

        if(mysqli_query($conn, $query)){
			header('Location: '.ROOT_URL.'');
		} else {
			echo 'ERROR: '. mysqli_error($conn);
		}
    } 

    
    $query = "SELECT * FROM roles";
    
    $result = mysqli_query($conn,$query);

    $roles = mysqli_fetch_all($result , MYSQLI_ASSOC);
    //var_dump($roles);

    mysqli_free_result($result);

    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>

    <style>
        .form{
            border: 1px solid black;
            padding: 10px;
            width: 200px;
            display: flex;
            flex-direction:column;
            justify-content : center;
            margin:200px auto ;
        }
    </style>

    <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" class="form">
        <label>Name: </label><br>
        <input type="text" name="name" placeholder = "Enter name...">
        <br>
        <label>Email: </label><br>
        <input type="email" name="email" placeholder = "Enter email...">
        <br>
        <label>Contact </label><br>
        <input type="number" name="contact" placeholder = "Enter contact..." >
        <br>
        <label>Address </label><br>
        <input type="text" name="address" placeholder = "Enter address...">
        <br>
        <select id="roles" name="role_name">
        <option>Choose role</option>
        <?php
        foreach($roles as $role_name){
            $role_name = $role_name['role_name'];
            echo "<option value = '$role_name'>$role_name</option>";
        }
        ?>
        </select>
        <br>
        <label>password </label>
        <input type="password" name="password" placeholder = "Enter password...">
        <br>
        <br>
        <button type="submit" name = "submit"><a href="<?php echo ROOT_URL; ?>"></a>Submit</button>
    </form>
</body>
</html>