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
        <select id="cars" name="cars">
        <option>Volvo</option>
        <option>Saab</option>
        <option>Fiat</option>
        <option>Audi</option>
        </select>
        <label>password </label><br>
        <input type="password" name="password" placeholder = "Enter password...">
        <br>
        <button type="submit" name = "submit"><a href="<?php echo ROOT_URL; ?>"></a>Submit</button>
    </form>
</body>
</html>